@extends('layouts.master')
@section('page_title', 'الخدمات الأكاديمية')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><i class="icon-graduation2 mr-2"></i> الخدمات الأكاديمية</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="icon-book icon-3x mb-3"></i>
                        <h5>تسجيل المقررات</h5>
                        <p>سجل في المقررات الدراسية</p>
                        <a href="{{ route('student_portal.course_registration') }}" class="btn btn-light">اذهب</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="icon-file-text icon-3x mb-3"></i>
                        <h5>السجل الأكاديمي</h5>
                        <p>عرض السجل الأكاديمي</p>
                        <a href="{{ route('student_portal.academic_records') }}" class="btn btn-light">اذهب</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="icon-phone icon-3x mb-3"></i>
                        <h5>طلبات الطلاب</h5>
                        <p>إرسال طلبات أكاديمية</p>
                        <a href="{{ route('student_portal.student_requests') }}" class="btn btn-light">اذهب</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
