@extends('layouts.master')
@section('page_title', 'السجل الأكاديمي')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><i class="icon-file-text mr-2"></i> السجل الأكاديمي</h5>
    </div>

    <div class="card-body">
        @if(isset($student) && $student)
            <div class="row">
                <div class="col-md-6">
                    <h6>معلومات الطالب</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>الاسم</th>
                            <td>{{ $student->user->name }}</td>
                        </tr>
                        <tr>
                            <th>رقم القبول</th>
                            <td>{{ $student->adm_no }}</td>
                        </tr>
                        <tr>
                            <th>الصف</th>
                            <td>{{ $student->my_class->name ?? 'غير محدد' }}</td>
                        </tr>
                        <tr>
                            <th>الشعبة</th>
                            <td>{{ $student->section->name ?? 'غير محدد' }}</td>
                        </tr>
                        <tr>
                            <th>سنة القبول</th>
                            <td>{{ $student->year_admitted }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <h6>معلومات إضافية</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>الحالة</th>
                            <td>
                                @if($student->grad)
                                    <span class="badge badge-success">متخرج</span>
                                @else
                                    <span class="badge badge-info">طالب حالي</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>الفصل الدراسي</th>
                            <td>{{ $student->session }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">لم يتم العثور على معلومات الطالب.</div>
        @endif
    </div>
</div>

@endsection
