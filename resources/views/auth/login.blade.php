@extends('layouts.login_master')

@section('content')
    <div class="page-content" style="background: linear-gradient(135deg, var(--university-primary) 0%, var(--university-secondary) 100%); min-height: 100vh;">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center" style="min-height: 100vh;">

                <!-- University Login Card -->
                <div class="login-form" style="width: 100%; max-width: 450px;">
                    <!-- University Header -->
                    <div class="text-center mb-4">
                        <div class="university-logo mb-3">
                            <div style="background: var(--university-white); border-radius: 50%; width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.15);">
                                <i class="icon-graduation2" style="font-size: 2.5rem; color: var(--university-primary);"></i>
                            </div>
                        </div>
                        <h3 style="color: var(--university-white); font-weight: 700; margin-bottom: 0.5rem;">نظام إدارة الطلاب</h3>
                        <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem;">مرحباً بكم في البوابة الأكاديمية</p>
                    </div>

                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="card mb-0" style="border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); border: none;">
                            <div class="card-body" style="padding: 2.5rem;">
                                <div class="text-center mb-4">
                                    <h5 class="mb-2" style="color: var(--university-primary); font-weight: 600;">تسجيل الدخول</h5>
                                    <span class="d-block text-muted">أدخل بيانات الاعتماد الخاصة بك</span>
                                </div>

                                @if ($errors->any())
                                <div class="alert alert-danger" style="border-radius: 10px; border-right: 4px solid var(--university-danger); background: rgba(239, 68, 68, 0.1);">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <span class="font-weight-semibold">خطأ!</span> {{ implode('<br>', $errors->all()) }}
                                </div>
                                @endif

                                <div class="form-group">
                                    <label class="form-label" style="color: var(--university-primary); font-weight: 600;">الرقم التسلسلي أو البريد الإلكتروني</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="identity" value="{{ old('identity') }}"
                                               placeholder="أدخل الرقم التسلسلي أو البريد الإلكتروني"
                                               style="border-radius: 10px; padding: 15px; border: 2px solid var(--university-border); font-size: 1rem;">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="background: var(--university-light); border: 2px solid var(--university-border); border-radius: 0 10px 10px 0;">
                                                <i class="icon-user" style="color: var(--university-primary);"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" style="color: var(--university-primary); font-weight: 600;">كلمة المرور</label>
                                    <div class="input-group">
                                        <input required name="password" type="password" class="form-control"
                                               placeholder="أدخل كلمة المرور"
                                               style="border-radius: 10px; padding: 15px; border: 2px solid var(--university-border); font-size: 1rem;">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="background: var(--university-light); border: 2px solid var(--university-border); border-radius: 0 10px 10px 0;">
                                                <i class="icon-lock2" style="color: var(--university-primary);"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <div class="form-check mb-0">
                                        <label class="form-check-label" style="color: var(--university-text); font-weight: 500;">
                                            <input type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }} data-fouc>
                                            تذكرني
                                        </label>
                                    </div>

                                    <a href="{{ route('password.request') }}" style="color: var(--university-secondary); font-weight: 500; text-decoration: none;">نسيت كلمة المرور؟</a>
                                </div>

                                <div class="form-group mb-4">
                                    <button type="submit" class="btn btn-primary btn-block"
                                            style="background: linear-gradient(135deg, var(--university-primary) 0%, var(--university-secondary) 100%);
                                                   border: none; border-radius: 10px; padding: 15px; font-size: 1.1rem; font-weight: 600;
                                                   box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3); transition: all 0.3s ease;">
                                        تسجيل الدخول <i class="icon-circle-left2 mr-2"></i>
                                    </button>
                                </div>

                                <!-- University Portal Links -->
                                <div class="text-center">
                                    <p class="text-muted mb-3">أو الوصول إلى البوابات الأخرى</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-outline-primary btn-sm" style="border-radius: 8px; font-weight: 500;">
                                                <i class="icon-graduation2 mr-1"></i> بوابة الطالب
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-outline-primary btn-sm" style="border-radius: 8px; font-weight: 500;">
                                                <i class="icon-users mr-1"></i> بوابة المدرس
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <!-- University Footer -->
                    <div class="text-center mt-4">
                        <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">
                            © 2024 نظام إدارة الطلاب الجامعي - جميع الحقوق محفوظة
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <style>
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .form-control:focus {
            border-color: var(--university-accent);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        .input-group-text {
            border-left: none !important;
        }

        .form-control {
            border-right: none !important;
        }

        .university-logo:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
    </style>
    @endsection
