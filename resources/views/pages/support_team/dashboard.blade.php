@extends('layouts.master')
@section('page_title', 'لوحة التحكم الرئيسية')
@section('content')

    <!-- University Welcome Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title mb-2">مرحباً بك، {{ Auth::user()->name }}</h2>
                <p class="text-muted mb-0">نظام إدارة الطلاب الجامعي - لوحة التحكم الرئيسية</p>
            </div>
            <div class="col-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">
                        <i class="icon-calendar3 mr-2"></i>
                        {{ date('Y/m/d') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(Qs::userIsTeamSA())
       <!-- University Statistics Cards -->
       <div class="row mb-4">
           <div class="col-sm-6 col-xl-3">
               <div class="stats-card">
                   <div class="media">
                       <div class="media-body">
                           <div class="stats-number">{{ $users->where('user_type', 'student')->count() }}</div>
                           <div class="stats-label">إجمالي الطلاب</div>
                       </div>
                       <div class="mr-3 align-self-center">
                           <div style="background: linear-gradient(135deg, var(--university-primary) 0%, var(--university-secondary) 100%);
                                       border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                               <i class="icon-users4" style="font-size: 1.8rem; color: white;"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="stats-card">
                   <div class="media">
                       <div class="media-body">
                           <div class="stats-number">{{ $users->where('user_type', 'teacher')->count() }}</div>
                           <div class="stats-label">إجمالي المدرسين</div>
                       </div>
                       <div class="mr-3 align-self-center">
                           <div style="background: linear-gradient(135deg, var(--university-success) 0%, #34d399 100%);
                                       border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                               <i class="icon-users2" style="font-size: 1.8rem; color: white;"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="stats-card">
                   <div class="media">
                       <div class="media-body">
                           <div class="stats-number">{{ $users->where('user_type', 'admin')->count() }}</div>
                           <div class="stats-label">إجمالي الإداريين</div>
                       </div>
                       <div class="mr-3 align-self-center">
                           <div style="background: linear-gradient(135deg, var(--university-warning) 0%, #fbbf24 100%);
                                       border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                               <i class="icon-pointer" style="font-size: 1.8rem; color: white;"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="stats-card">
                   <div class="media">
                       <div class="media-body">
                           <div class="stats-number">{{ $users->where('user_type', 'parent')->count() }}</div>
                           <div class="stats-label">إجمالي أولياء الأمور</div>
                       </div>
                       <div class="mr-3 align-self-center">
                           <div style="background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
                                       border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                               <i class="icon-user" style="font-size: 1.8rem; color: white;"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <!-- University Quick Actions -->
       <div class="row mb-4">
           <div class="col-md-3">
               <div class="card" style="border-right: 4px solid var(--university-primary);">
                   <div class="card-body text-center">
                       <i class="icon-users4" style="font-size: 2.5rem; color: var(--university-primary); margin-bottom: 1rem;"></i>
                       <h6 class="card-title">إدارة الطلاب</h6>
                       <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">عرض الطلاب</a>
                   </div>
               </div>
           </div>
           <div class="col-md-3">
               <div class="card" style="border-right: 4px solid var(--university-success);">
                   <div class="card-body text-center">
                       <i class="icon-users2" style="font-size: 2.5rem; color: var(--university-success); margin-bottom: 1rem;"></i>
                       <h6 class="card-title">إدارة المدرسين</h6>
                       <a href="{{ route('users.index') }}" class="btn btn-success btn-sm">عرض المدرسين</a>
                   </div>
               </div>
           </div>
           <div class="col-md-3">
               <div class="card" style="border-right: 4px solid var(--university-warning);">
                   <div class="card-body text-center">
                       <i class="icon-windows2" style="font-size: 2.5rem; color: var(--university-warning); margin-bottom: 1rem;"></i>
                       <h6 class="card-title">إدارة الفصول</h6>
                       <a href="{{ route('classes.index') }}" class="btn btn-warning btn-sm">عرض الفصول</a>
                   </div>
               </div>
           </div>
           <div class="col-md-3">
               <div class="card" style="border-right: 4px solid #8b5cf6;">
                   <div class="card-body text-center">
                       <i class="icon-books" style="font-size: 2.5rem; color: #8b5cf6; margin-bottom: 1rem;"></i>
                       <h6 class="card-title">إدارة الامتحانات</h6>
                       <a href="{{ route('exams.index') }}" class="btn btn-sm" style="background: #8b5cf6; color: white;">عرض الامتحانات</a>
                   </div>
               </div>
           </div>
       </div>
       @endif

    {{--University Events Calendar--}}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="icon-calendar3 mr-2" style="color: var(--university-primary);"></i>
                تقويم الأحداث الجامعية
            </h5>
        </div>

        <div class="card-body">
            <div class="fullcalendar-basic"></div>
        </div>
    </div>

    <!-- University Recent Activities -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="icon-history mr-2" style="color: var(--university-primary);"></i>
                        الأنشطة الأخيرة
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker" style="background: var(--university-primary);"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">تم إضافة طالب جديد</h6>
                                <p class="timeline-text">تم تسجيل طالب جديد في النظام</p>
                                <small class="text-muted">منذ ساعتين</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker" style="background: var(--university-success);"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">تم إنشاء امتحان جديد</h6>
                                <p class="timeline-text">تم إضافة امتحان الرياضيات للفصل الأول</p>
                                <small class="text-muted">منذ 4 ساعات</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="icon-bell2 mr-2" style="color: var(--university-primary);"></i>
                        الإشعارات
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0">
                            <div class="media">
                                <div class="mr-3">
                                    <div style="width: 8px; height: 8px; background: var(--university-primary); border-radius: 50%;"></div>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">اجتماع هيئة التدريس</h6>
                                    <small class="text-muted">غداً الساعة 10:00 صباحاً</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 px-0">
                            <div class="media">
                                <div class="mr-3">
                                    <div style="width: 8px; height: 8px; background: var(--university-warning); border-radius: 50%;"></div>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">موعد تسليم التقارير</h6>
                                    <small class="text-muted">خلال 3 أيام</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--university-border);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-marker {
            position: absolute;
            left: -23px;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid var(--university-white);
        }

        .timeline-title {
            color: var(--university-primary);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .timeline-text {
            color: var(--university-text);
            margin-bottom: 5px;
        }
    </style>
    @endsection
