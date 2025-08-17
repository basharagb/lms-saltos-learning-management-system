@extends('layouts.master')
@section('page_title', 'تفاصيل المقرر - ' . $course->name)
@section('content')

<div class="row">
    <div class="col-md-8">
        <!-- Course Details Card -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">تفاصيل المقرر</h6>
                {!! Qs::getPanelOptions() !!}
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="font-weight-bold">اسم المقرر:</td>
                                <td>{{ $course->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">رمز المقرر:</td>
                                <td><span class="badge badge-primary">{{ $course->code }}</span></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">الساعات المعتمدة:</td>
                                <td>{{ $course->credit_hours }} ساعة</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">البرنامج الأكاديمي:</td>
                                <td>{{ $course->myClass->name ?? 'غير محدد' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="font-weight-bold">المدرس:</td>
                                <td>{{ $course->teacher->name ?? 'غير محدد' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">الفصل الدراسي:</td>
                                <td>
                                    @if($course->semester == 'first') الفصل الأول
                                    @elseif($course->semester == 'second') الفصل الثاني
                                    @else الفصل الصيفي
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">السنة الأكاديمية:</td>
                                <td>{{ $course->academic_year }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">الحالة:</td>
                                <td>
                                    <span class="badge badge-{{ $course->status == 'active' ? 'success' : 'danger' }}">
                                        {{ $course->status == 'active' ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($course->description)
                <div class="mt-3">
                    <h6 class="font-weight-bold">وصف المقرر:</h6>
                    <p class="text-muted">{{ $course->description }}</p>
                </div>
                @endif

                <div class="text-right mt-4">
                    @if(Qs::userIsTeamSA())
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">
                        <i class="icon-pencil mr-2"></i>تعديل المقرر
                    </a>
                    @endif
                    <a href="{{ route('courses.enrollments', $course->id) }}" class="btn btn-success">
                        <i class="icon-users mr-2"></i>إدارة التسجيلات
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                        <i class="icon-arrow-right8 mr-2"></i>العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Statistics Card -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">إحصائيات المقرر</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="mb-3">
                        <h3 class="text-primary mb-1">{{ $course->enrollments->count() }}</h3>
                        <p class="text-muted mb-0">إجمالي الطلاب المسجلين</p>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="text-success mb-1">{{ $course->enrollments->where('status', 'enrolled')->count() }}</h5>
                            <small class="text-muted">مسجل</small>
                        </div>
                        <div class="col-4">
                            <h5 class="text-info mb-1">{{ $course->enrollments->where('status', 'completed')->count() }}</h5>
                            <small class="text-muted">مكتمل</small>
                        </div>
                        <div class="col-4">
                            <h5 class="text-warning mb-1">{{ $course->enrollments->where('status', 'dropped')->count() }}</h5>
                            <small class="text-muted">منسحب</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">آخر التسجيلات</h6>
            </div>
            <div class="card-body">
                @forelse($enrolled_students->take(5) as $enrollment)
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded-circle mr-3" style="width: 40px; height: 40px;" 
                         src="{{ $enrollment->student->user->photo ?? '/assets/images/default-avatar.png' }}" 
                         alt="صورة الطالب">
                    <div class="flex-1">
                        <h6 class="mb-0">{{ $enrollment->student->user->name }}</h6>
                        <small class="text-muted">{{ $enrollment->enrollment_date->format('Y-m-d') }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center">لا توجد تسجيلات</p>
                @endforelse
                
                @if($enrolled_students->count() > 5)
                <div class="text-center">
                    <a href="{{ route('courses.enrollments', $course->id) }}" class="btn btn-sm btn-outline-primary">
                        عرض جميع التسجيلات
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
