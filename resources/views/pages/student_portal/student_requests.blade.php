@extends('layouts.master')
@section('page_title', 'طلبات الطلاب')
@section('content')

    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title mb-2">
                    <i class="icon-file-text2 mr-3" style="color: var(--university-primary);"></i>
                    طلبات الطلاب
                </h2>
                <p class="text-muted mb-0">تقديم الطلبات والحصول على الوثائق الرسمية</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('student_portal.index') }}" class="btn btn-outline-primary">
                    <i class="icon-arrow-right8 mr-2"></i>
                    العودة للبوابة الطلابية
                </a>
            </div>
        </div>
    </div>

    <!-- Request Categories -->
    <div class="row">
        <!-- Academic Documents -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header" style="background: linear-gradient(135deg, var(--university-primary) 0%, var(--university-secondary) 100%); color: white;">
                    <h6 class="card-title mb-0">
                        <i class="icon-file-text mr-2"></i>
                        الوثائق الأكاديمية
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <div class="mr-3">
                                    <i class="icon-certificate" style="color: var(--university-primary); font-size: 1.5rem;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">كشف درجات</h6>
                                    <small class="text-muted">طلب كشف درجات رسمي</small>
                                </div>
                                <div class="ml-auto">
                                    <span class="badge badge-primary">متاح</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <div class="mr-3">
                                    <i class="icon-graduation" style="color: var(--university-primary); font-size: 1.5rem;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">شهادة تخرج</h6>
                                    <small class="text-muted">طلب شهادة تخرج مؤقتة</small>
                                </div>
                                <div class="ml-auto">
                                    <span class="badge badge-primary">متاح</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <div class="mr-3">
                                    <i class="icon-file-check" style="color: var(--university-primary); font-size: 1.5rem;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">شهادة انتظام</h6>
                                    <small class="text-muted">شهادة انتظام في الدراسة</small>
                                </div>
                                <div class="ml-auto">
                                    <span class="badge badge-primary">متاح</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Administrative Requests -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header" style="background: linear-gradient(135deg, var(--university-success) 0%, #34d399 100%); color: white;">
                    <h6 class="card-title mb-0">
                        <i class="icon-cog mr-2"></i>
                        الطلبات الإدارية
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <div class="mr-3">
                                    <i class="icon-switch2" style="color: var(--university-success); font-size: 1.5rem;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">تحويل تخصص</h6>
                                    <small class="text-muted">طلب تحويل إلى تخصص آخر</small>
                                </div>
                                <div class="ml-auto">
                                    <span class="badge badge-success">متاح</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <div class="mr-3">
                                    <i class="icon-pause2" style="color: var(--university-success); font-size: 1.5rem;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">تأجيل دراسة</h6>
                                    <small class="text-muted">طلب تأجيل الدراسة لفصل دراسي</small>
                                </div>
                                <div class="ml-auto">
                                    <span class="badge badge-success">متاح</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <div class="mr-3">
                                    <i class="icon-cross2" style="color: var(--university-success); font-size: 1.5rem;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1">انسحاب من مقرر</h6>
                                    <small class="text-muted">طلب انسحاب من مقرر دراسي</small>
                                </div>
                                <div class="ml-auto">
                                    <span class="badge badge-warning">محدود</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Form -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="icon-plus3 mr-2" style="color: var(--university-primary);"></i>
                        تقديم طلب جديد
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">نوع الطلب</label>
                                    <select class="form-control">
                                        <option value="">اختر نوع الطلب</option>
                                        <option value="transcript">كشف درجات</option>
                                        <option value="certificate">شهادة تخرج</option>
                                        <option value="enrollment">شهادة انتظام</option>
                                        <option value="transfer">تحويل تخصص</option>
                                        <option value="defer">تأجيل دراسة</option>
                                        <option value="withdraw">انسحاب من مقرر</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">الأولوية</label>
                                    <select class="form-control">
                                        <option value="normal">عادي (5-7 أيام عمل)</option>
                                        <option value="urgent">عاجل (2-3 أيام عمل)</option>
                                        <option value="emergency">طارئ (24 ساعة)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">تفاصيل الطلب</label>
                            <textarea class="form-control" rows="4" placeholder="اكتب تفاصيل طلبك هنا..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">المرفقات (اختياري)</label>
                            <input type="file" class="form-control" multiple>
                            <small class="text-muted">يمكنك إرفاق ملفات داعمة للطلب</small>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-paperplane mr-2"></i>
                                تقديم الطلب
                            </button>
                            <button type="reset" class="btn btn-secondary mr-2">
                                <i class="icon-reset mr-2"></i>
                                إعادة تعيين
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Request Status -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="icon-history mr-2" style="color: var(--university-primary);"></i>
                        طلباتي السابقة
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker" style="background: var(--university-success);"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">كشف درجات</h6>
                                <p class="timeline-text">تم الموافقة والإرسال</p>
                                <small class="text-muted">منذ 3 أيام</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker" style="background: var(--university-warning);"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">شهادة انتظام</h6>
                                <p class="timeline-text">قيد المراجعة</p>
                                <small class="text-muted">منذ يوم واحد</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help & Support -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="icon-help mr-2" style="color: var(--university-primary);"></i>
                        المساعدة والدعم
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">هل تحتاج مساعدة في تقديم طلبك؟</p>
                    <div class="btn-group-vertical btn-block">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="icon-phone mr-2"></i>
                            اتصل بالدعم الفني
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="icon-mail mr-2"></i>
                            إرسال بريد إلكتروني
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="icon-question3 mr-2"></i>
                            الأسئلة الشائعة
                        </button>
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

        .list-group-item:hover {
            background-color: var(--university-light);
        }
    </style>

@endsection
