<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Helpers\Qs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['index', 'show']]);
        $this->middleware('super_admin', ['only' => ['destroy']]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $query = Course::with(['myClass', 'teacher', 'enrollments']);

        // Apply filters
        if ($request->has('class_id') && $request->class_id != '') {
            $query->where('my_class_id', $request->class_id);
        }

        if ($request->has('semester') && $request->semester != '') {
            $query->where('semester', $request->semester);
        }

        if ($request->has('academic_year') && $request->academic_year != '') {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $data['courses'] = $query->orderBy('name')->get();
        $data['my_classes'] = $this->my_class->all();
        $data['filters'] = $request->all();
        $data['total_courses'] = $data['courses']->count();

        return view('pages.support_team.courses.index', $data);
    }

    public function create()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['teachers'] = $this->user->getUserByType('teacher');
        $data['current_year'] = Qs::getSetting('current_session');
        
        return view('pages.support_team.courses.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:20|unique:courses,code',
            'description' => 'nullable|string',
            'credit_hours' => 'required|integer|min:1|max:6',
            'my_class_id' => 'required|exists:my_classes,id',
            'teacher_id' => 'nullable|exists:users,id',
            'semester' => 'required|in:first,second,summer',
            'academic_year' => 'required|string|max:20',
            'status' => 'required|in:active,inactive'
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('flash_success', 'تم إنشاء المقرر بنجاح');
    }

    public function show($id)
    {
        $data['course'] = Course::with(['myClass', 'teacher', 'enrollments.student.user'])->findOrFail($id);
        $data['enrolled_students'] = $data['course']->enrollments()->enrolled()->with('student.user')->get();
        
        return view('pages.support_team.courses.show', $data);
    }

    public function edit($id)
    {
        $data['course'] = Course::findOrFail($id);
        $data['my_classes'] = $this->my_class->all();
        $data['teachers'] = $this->user->getUserByType('teacher');
        
        return view('pages.support_team.courses.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:20|unique:courses,code,' . $id,
            'description' => 'nullable|string',
            'credit_hours' => 'required|integer|min:1|max:6',
            'my_class_id' => 'required|exists:my_classes,id',
            'teacher_id' => 'nullable|exists:users,id',
            'semester' => 'required|in:first,second,summer',
            'academic_year' => 'required|string|max:20',
            'status' => 'required|in:active,inactive'
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('flash_success', 'تم تحديث المقرر بنجاح');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return back()->with('flash_success', 'تم حذف المقرر بنجاح');
    }

    public function enrollments($id)
    {
        $data['course'] = Course::with(['myClass', 'teacher'])->findOrFail($id);
        $data['enrollments'] = CourseEnrollment::where('course_id', $id)
                                              ->with(['student.user'])
                                              ->orderBy('enrollment_date', 'desc')
                                              ->get();
        
        // Get available students for enrollment (optional for the view)
        $enrolledStudentIds = $data['enrollments']->pluck('student_id')->toArray();
        $data['available_students'] = collect(); // Empty collection for now
        
        return view('pages.support_team.courses.enrollments', $data);
    }

    public function enroll(Request $request, $id)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:student_records,id'
        ]);

        $course = Course::findOrFail($id);
        
        foreach ($request->student_ids as $studentId) {
            CourseEnrollment::firstOrCreate([
                'course_id' => $id,
                'student_id' => $studentId
            ], [
                'status' => 'enrolled',
                'enrollment_date' => now()
            ]);
        }

        return back()->with('flash_success', 'تم تسجيل الطلاب في المقرر بنجاح');
    }

    public function updateEnrollment(Request $request, $enrollmentId)
    {
        $request->validate([
            'status' => 'required|in:enrolled,dropped,completed',
            'grade' => 'nullable|numeric|min:0|max:100',
            'grade_letter' => 'nullable|string|max:2'
        ]);

        $enrollment = CourseEnrollment::findOrFail($enrollmentId);
        $enrollment->update($request->all());

        if ($request->status === 'completed') {
            $enrollment->completion_date = now();
            $enrollment->save();
        }

        return back()->with('flash_success', 'تم تحديث حالة التسجيل بنجاح');
    }
}
