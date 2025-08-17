<?php

namespace App\Http\Controllers\SupportTeam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Qs;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Repositories\StudentRepo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ModernStudentController extends Controller
{
    protected $loc, $my_class, $user, $student;

    public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user, StudentRepo $student)
    {
        $this->middleware('teamSA', ['except' => ['index', 'search', 'show']]);
        $this->middleware('super_admin', ['only' => ['destroy', 'bulkDelete']]);

        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->user = $user;
        $this->student = $student;
    }

    public function index(Request $request)
    {
        $data['my_classes'] = $this->my_class->all();

        // Get all students with their relationships for comprehensive listing
        // Only include students that have valid user relationships
        $students = $this->student->getAllWithValidUsers()->get();

        // Apply filters if provided
        if ($request->has('class_id') && $request->class_id != '') {
            $students = $students->where('my_class_id', $request->class_id);
            $data['sections'] = $this->my_class->getClassSections($request->class_id);
        } else {
            $data['sections'] = collect();
        }

        if ($request->has('section_id') && $request->section_id != '') {
            $students = $students->where('section_id', $request->section_id);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $students = $students->filter(function ($student) use ($search) {
                // Add null checks for user properties
                if (!$student->user) {
                    return false;
                }

                return stripos($student->user->name ?? '', $search) !== false ||
                       stripos($student->user->email ?? '', $search) !== false ||
                       stripos($student->adm_no ?? '', $search) !== false ||
                       stripos($student->user->username ?? '', $search) !== false ||
                       stripos($student->user->phone ?? '', $search) !== false;
            });
        }

        // Sort students with null checks
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        if ($sortBy === 'name') {
            $students = $sortOrder === 'desc'
                ? $students->sortByDesc(function($student) { return $student->user->name ?? 'zzz'; })
                : $students->sortBy(function($student) { return $student->user->name ?? 'zzz'; });
        } elseif ($sortBy === 'adm_no') {
            $students = $sortOrder === 'desc'
                ? $students->sortByDesc('adm_no')
                : $students->sortBy('adm_no');
        } elseif ($sortBy === 'class') {
            $students = $sortOrder === 'desc'
                ? $students->sortByDesc(function($student) { return $student->my_class->name ?? 'zzz'; })
                : $students->sortBy(function($student) { return $student->my_class->name ?? 'zzz'; });
        } elseif ($sortBy === 'email') {
            $students = $sortOrder === 'desc'
                ? $students->sortByDesc(function($student) { return $student->user->email ?? 'zzz'; })
                : $students->sortBy(function($student) { return $student->user->email ?? 'zzz'; });
        }

        $data['students'] = $students;
        $data['total_students'] = $students->count();
        $data['filters'] = $request->all();

        return view('pages.modern_student.comprehensive_list', $data);
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
        $class_id = $request->get('class_id');
        
        $query = $this->student->getRecord([]);
        
        if ($class_id) {
            $query = $query->where('my_class_id', $class_id);
        }
        
        $students = $query->whereHas('user', function($q) use ($term) {
            $q->where('name', 'LIKE', "%{$term}%")
              ->orWhere('email', 'LIKE', "%{$term}%");
        })->orWhere('adm_no', 'LIKE', "%{$term}%")
          ->with(['user', 'my_class', 'section'])
          ->limit(10)
          ->get();
        
        return response()->json($students->map(function($student) {
            return [
                'id' => $student->id,
                'name' => $student->user->name,
                'adm_no' => $student->adm_no,
                'email' => $student->user->email,
                'class' => $student->my_class->name,
                'section' => $student->section->name,
                'photo' => $student->user->photo,
                'hash' => Qs::hash($student->id)
            ];
        }));
    }

    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();

        /* Prevent Other Students/Parents from viewing Profile of others */
        if(auth()->id() != $data['sr']->user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild($data['sr']->user_id, auth()->id())){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.modern_student.show', $data);
    }

    public function create()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['dorms'] = $this->student->getAllDorms();
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        $data['blood_groups'] = \App\Models\BloodGroup::all();
        
        return view('pages.modern_student.create', $data);
    }

    public function bulkDelete(Request $request)
    {
        $student_ids = $request->get('student_ids', []);
        
        foreach ($student_ids as $id) {
            $sr_id = Qs::decodeHash($id);
            if ($sr_id) {
                $sr = $this->student->getRecord(['id' => $sr_id])->first();
                if ($sr) {
                    $this->user->delete($sr->user->id);
                }
            }
        }
        
        return response()->json(['success' => true, 'message' => 'تم حذف الطلاب المحددين بنجاح']);
    }

    public function getClassSections($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        return response()->json($sections);
    }

    /**
     * Get students data for DataTables AJAX requests
     */
    public function getStudentsData(Request $request)
    {
        $students = $this->student->getAllWithValidUsers()->get();

        // Apply search filter
        if ($request->has('search') && $request->search['value'] != '') {
            $search = $request->search['value'];
            $students = $students->filter(function ($student) use ($search) {
                // Add null checks for user properties
                if (!$student->user) {
                    return false;
                }

                return stripos($student->user->name ?? '', $search) !== false ||
                       stripos($student->user->email ?? '', $search) !== false ||
                       stripos($student->adm_no ?? '', $search) !== false ||
                       stripos($student->user->username ?? '', $search) !== false ||
                       stripos($student->user->phone ?? '', $search) !== false;
            });
        }

        // Apply class filter
        if ($request->has('class_filter') && $request->class_filter != '') {
            $students = $students->where('my_class_id', $request->class_filter);
        }

        // Apply section filter
        if ($request->has('section_filter') && $request->section_filter != '') {
            $students = $students->where('section_id', $request->section_filter);
        }

        $totalRecords = $students->count();

        // Apply sorting
        $orderColumn = $request->order[0]['column'] ?? 0;
        $orderDir = $request->order[0]['dir'] ?? 'asc';

        $columns = ['user.name', 'adm_no', 'my_class.name', 'section.name', 'user.email', 'user.phone'];
        $sortBy = $columns[$orderColumn] ?? 'user.name';

        if (strpos($sortBy, '.') !== false) {
            $parts = explode('.', $sortBy);
            if ($parts[0] === 'user') {
                $students = $orderDir === 'desc'
                    ? $students->sortByDesc('user.' . $parts[1])
                    : $students->sortBy('user.' . $parts[1]);
            } elseif ($parts[0] === 'my_class') {
                $students = $orderDir === 'desc'
                    ? $students->sortByDesc('my_class.' . $parts[1])
                    : $students->sortBy('my_class.' . $parts[1]);
            } elseif ($parts[0] === 'section') {
                $students = $orderDir === 'desc'
                    ? $students->sortByDesc('section.' . $parts[1])
                    : $students->sortBy('section.' . $parts[1]);
            }
        } else {
            $students = $orderDir === 'desc'
                ? $students->sortByDesc($sortBy)
                : $students->sortBy($sortBy);
        }

        // Apply pagination
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $students = $students->slice($start, $length);

        $data = [];
        foreach ($students as $student) {
            // Skip students without user records (defensive programming)
            if (!$student->user) {
                continue;
            }

            $data[] = [
                'id' => $student->id,
                'photo' => '<img class="rounded-circle" style="height: 40px; width: 40px;" src="' . ($student->user->photo ?? '/assets/images/default-avatar.png') . '" alt="صورة">',
                'name' => $student->user->name ?? 'غير محدد',
                'adm_no' => $student->adm_no ?? 'غير محدد',
                'class' => $student->my_class->name ?? 'غير محدد',
                'section' => $student->section->name ?? 'غير محدد',
                'email' => $student->user->email ?? 'غير محدد',
                'phone' => $student->user->phone ?? 'غير محدد',
                'actions' => $this->getActionButtons($student)
            ];
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ]);
    }

    /**
     * Generate action buttons for each student
     */
    private function getActionButtons($student)
    {
        // Return empty if no user record
        if (!$student->user) {
            return '<span class="text-muted">لا توجد إجراءات متاحة</span>';
        }

        $buttons = '<div class="list-icons">';
        $buttons .= '<div class="dropdown">';
        $buttons .= '<a href="#" class="list-icons-item" data-toggle="dropdown">';
        $buttons .= '<i class="icon-menu9"></i>';
        $buttons .= '</a>';
        $buttons .= '<div class="dropdown-menu dropdown-menu-left">';

        // View Profile
        $buttons .= '<a href="' . route('students.show', Qs::hash($student->id)) . '" class="dropdown-item">';
        $buttons .= '<i class="icon-eye"></i> عرض الملف الشخصي</a>';

        // Edit (only for authorized users)
        if (Qs::userIsTeamSA()) {
            $buttons .= '<a href="' . route('students.edit', Qs::hash($student->id)) . '" class="dropdown-item">';
            $buttons .= '<i class="icon-pencil"></i> تعديل</a>';

            $buttons .= '<a href="' . route('st.reset_pass', Qs::hash($student->user->id)) . '" class="dropdown-item">';
            $buttons .= '<i class="icon-lock"></i> إعادة تعيين كلمة المرور</a>';
        }

        // Marksheet
        $buttons .= '<a target="_blank" href="' . route('marks.year_selector', Qs::hash($student->user->id)) . '" class="dropdown-item">';
        $buttons .= '<i class="icon-check"></i> كشف الدرجات</a>';

        $buttons .= '</div>';
        $buttons .= '</div>';
        $buttons .= '</div>';

        return $buttons;
    }
}
