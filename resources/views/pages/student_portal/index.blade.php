@extends('layouts.master')
@section('page_title', 'البوابة الطلابية')
@section('content')

    <!-- University Student Portal Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title mb-2">
                    <i class="icon-graduation2 mr-3" style="color: var(--university-primary);"></i>
                    البوابة الطلابية الجامعية
                </h2>
                <p class="text-muted mb-0">مرحباً {{ Auth::user()->name }}، اختر الخدمة التي تحتاجها</p>
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

    <!-- Student Portal Services Grid -->
    <div class="row">
        <!-- Academic Services -->
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border-right: 4px solid var(--university-primary); transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div style="background: linear-gradient(135deg, var(--university-primary) 0%, var(--university-secondary) 100%); 
                                    border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="icon-books" style="font-size: 2.5rem; color: white;"></i>
                        </div>
                    </div>
                    <h5 class="card-title mb-3" style="color: var(--university-primary);">الخدمات الأكاديمية</h5>
                    <p class="card-text text-muted mb-4">الوصول إلى الخدمات الأكاديمية والمقررات الدراسية</p>
                    <a href="{{ route('student_portal.academic_services') }}" class="btn btn-primary btn-block">
                        <i class="icon-arrow-left8 mr-2"></i>
                        دخول الخدمات الأكاديمية
                    </a>
                </div>
            </div>
        </div>

        <!-- Student Requests -->
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border-right: 4px solid var(--university-success); transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div style="background: linear-gradient(135deg, var(--university-success) 0%, #34d399 100%); 
                                    border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="icon-file-text2" style="font-size: 2.5rem; color: white;"></i>
                        </div>
                    </div>
                    <h5 class="card-title mb-3" style="color: var(--university-success);">طلبات الطلاب</h5>
                    <p class="card-text text-muted mb-4">تقديم الطلبات والوثائق الرسمية</p>
                    <a href="{{ route('student_portal.student_requests') }}" class="btn btn-success btn-block">
                        <i class="icon-arrow-left8 mr-2"></i>
                        تقديم طلب جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Registration -->
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border-right: 4px solid var(--university-warning); transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div style="background: linear-gradient(135deg, var(--university-warning) 0%, #fbbf24 100%); 
                                    border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="icon-plus3" style="font-size: 2.5rem; color: white;"></i>
                        </div>
                    </div>
                    <h5 class="card-title mb-3" style="color: var(--university-warning);">تسجيل المقررات</h5>
                    <p class="card-text text-muted mb-4">تسجيل وإدارة المقررات الدراسية</p>
                    <a href="{{ route('student_portal.course_registration') }}" class="btn btn-warning btn-block">
                        <i class="icon-arrow-left8 mr-2"></i>
                        تسجيل المقررات
                    </a>
                </div>
            </div>
        </div>

        <!-- Academic Records -->
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border-right: 4px solid #8b5cf6; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div style="background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%); 
                                    border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="icon-file-stats" style="font-size: 2.5rem; color: white;"></i>
                        </div>
                    </div>
                    <h5 class="card-title mb-3" style="color: #8b5cf6;">السجل الأكاديمي</h5>
                    <p class="card-text text-muted mb-4">عرض الدرجات والسجل الأكاديمي</p>
                    <a href="{{ route('student_portal.academic_records') }}" class="btn btn-block" style="background: #8b5cf6; color: white;">
                        <i class="icon-arrow-left8 mr-2"></i>
                        عرض السجل الأكاديمي
                    </a>
                </div>
            </div>
        </div>

        <!-- Financial Services -->
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border-right: 4px solid #ef4444; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div style="background: linear-gradient(135deg, #ef4444 0%, #f87171 100%); 
                                    border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="icon-credit-card" style="font-size: 2.5rem; color: white;"></i>
                        </div>
                    </div>
                    <h5 class="card-title mb-3" style="color: #ef4444;">الخدمات المالية</h5>
                    <p class="card-text text-muted mb-4">الرسوم الجامعية والخدمات المالية</p>
                    <a href="{{ route('student_portal.financial_services') }}" class="btn btn-block" style="background: #ef4444; color: white;">
                        <i class="icon-arrow-left8 mr-2"></i>
                        الخدمات المالية
                    </a>
                </div>
            </div>
        </div>

        <!-- E-Learning -->
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border-right: 4px solid #06b6d4; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div style="background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%); 
                                    border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="icon-laptop" style="font-size: 2.5rem; color: white;"></i>
                        </div>
                    </div>
                    <h5 class="card-title mb-3" style="color: #06b6d4;">التعلم الإلكتروني</h5>
                    <p class="card-text text-muted mb-4">منصة التعلم الإلكتروني والمحاضرات</p>
                    <a href="{{ route('student_portal.elearning') }}" class="btn btn-block" style="background: #06b6d4; color: white;">
                        <i class="icon-arrow-left8 mr-2"></i>
                        دخول المنصة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    @if(Qs::userIsStudent())
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="icon-stats-dots mr-2" style="color: var(--university-primary);"></i>
                        إحصائيات سريعة
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stats-card text-center">
                                <div class="stats-number">{{ $subjects->count() ?? 0 }}</div>
                                <div class="stats-label">المقررات المسجلة</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card text-center">
                                <div class="stats-number">{{ $my_class->name ?? 'غير محدد' }}</div>
                                <div class="stats-label">البرنامج الأكاديمي</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card text-center">
                                <div class="stats-number">0</div>
                                <div class="stats-label">الطلبات المعلقة</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card text-center">
                                <div class="stats-number">جيد جداً</div>
                                <div class="stats-label">المعدل التراكمي</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>

@endsection
