<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Qs;

class StudentPortalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['my_class'] = Qs::findMyClass(Qs::findStudentRecord(auth()->id())->my_class_id ?? '');
        $data['subjects'] = Qs::getSubjectsByClass($data['my_class']->id ?? '');
        
        return view('pages.student_portal.index', $data);
    }

    public function academicServices()
    {
        return view('pages.student_portal.academic_services');
    }

    public function studentRequests()
    {
        return view('pages.student_portal.student_requests');
    }

    public function courseRegistration()
    {
        $data['my_class'] = Qs::findMyClass(Qs::findStudentRecord(auth()->id())->my_class_id ?? '');
        $data['subjects'] = Qs::getSubjectsByClass($data['my_class']->id ?? '');
        
        return view('pages.student_portal.course_registration', $data);
    }

    public function academicRecords()
    {
        $student_record = Qs::findStudentRecord(auth()->id());
        $data['student'] = $student_record;
        $data['my_class'] = Qs::findMyClass($student_record->my_class_id ?? '');
        
        return view('pages.student_portal.academic_records', $data);
    }

    public function financialServices()
    {
        return view('pages.student_portal.financial_services');
    }

    public function elearning()
    {
        return view('pages.student_portal.elearning');
    }
}
