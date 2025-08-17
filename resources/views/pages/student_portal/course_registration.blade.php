@extends('layouts.master')
@section('page_title', 'تسجيل المقررات')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><i class="icon-book mr-2"></i> تسجيل المقررات</h5>
    </div>

    <div class="card-body">
        @if(isset($my_class) && $my_class)
            <h6>الصف: {{ $my_class->name }}</h6>
            
            @if(isset($subjects) && $subjects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>المقرر</th>
                                <th>الاسم المختصر</th>
                                <th>المعلم</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->slug }}</td>
                                    <td>{{ $subject->teacher->name ?? 'غير محدد' }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm">تسجيل</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">لا توجد مقررات متاحة للتسجيل في هذا الصف.</div>
            @endif
        @else
            <div class="alert alert-warning">لم يتم العثور على معلومات الصف.</div>
        @endif
    </div>
</div>

@endsection
