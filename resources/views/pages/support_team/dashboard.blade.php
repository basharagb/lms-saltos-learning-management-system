@extends('layouts.master')
@section('page_title', 'لوحة التحكم الرئيسية')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard-responsive.css') }}?v={{ time() }}">
@endsection

@section('content')

    <!-- Force Refresh Button (Remove in production) -->
    <div class="alert alert-warning">
        <strong>تحديث الصفحة:</strong> 
        <button onclick="location.reload(true)" class="btn btn-sm btn-warning">تحديث قوي</button>
        <span class="ml-2">أو اضغط F5 + Ctrl (Cmd على Mac)</span>
    </div>

    <!-- Debug Info (Remove in production) -->
    @if(config('app.debug'))
    <div class="alert alert-info">
        <strong>Debug Info:</strong>
        User Type: {{ Auth::user()->user_type ?? 'Not set' }}<br>
        Is Team SAT: {{ Qs::userIsTeamSAT() ? 'Yes' : 'No' }}<br>
        Users Count: {{ isset($users) ? $users->count() : 'Not loaded' }}<br>
        Current Time: {{ time() }}
    </div>
    @endif

    <!-- Modern Dashboard Header -->
    <div class="dashboard-hero mb-4">
        <div class="dashboard-hero-content">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <h1 class="dashboard-hero-title">
                        <i class="icon-home4 mr-3"></i>
                        مرحباً بك، {{ Auth::user()->name }}
                    </h1>
                    <p class="dashboard-hero-subtitle">
                        نظام إدارة الطلاب الجامعي - لوحة التحكم الرئيسية
                    </p>
                    <div class="dashboard-hero-info">
                        <span class="dashboard-hero-badge">
                            <i class="icon-calendar3 mr-2"></i>
                            الفصل الدراسي الحالي: 2018-2019
                        </span>
                        <span class="dashboard-hero-badge">
                            <i class="icon-clock mr-2"></i>
                            {{ date('Y/m/d') }}
                        </span>
                    </div>
                </div>
                <div class="col-12 col-lg-4 text-center text-lg-right">
                    <div class="dashboard-hero-avatar">
                        <img src="{{ Auth::user()->photo ?? asset('global_assets/images/placeholders/user.png') }}" 
                             alt="صورة المستخدم" class="rounded-circle">
                        <div class="dashboard-hero-status">
                            <span class="status-dot"></span>
                            متصل
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Qs::userIsTeamSAT())
       <!-- Statistics Cards Grid -->
       <div class="row mb-4 dashboard-stats">
           <div class="col-12 col-sm-6 col-xl-3">
               <div class="stats-card stats-card-primary">
                   <div class="stats-card-icon">
                       <i class="icon-users4"></i>
                   </div>
                   <div class="stats-card-content">
                       <div class="stats-card-number">{{ $users->where('user_type', 'student')->count() }}</div>
                       <div class="stats-card-label">إجمالي الطلاب</div>
                       <div class="stats-card-change">
                           <i class="icon-arrow-up5 text-success"></i>
                           <span class="text-success">+12%</span>
                           <span class="text-muted">من الشهر الماضي</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-12 col-sm-6 col-xl-3">
               <div class="stats-card stats-card-success">
                   <div class="stats-card-icon">
                       <i class="icon-users2"></i>
                   </div>
                   <div class="stats-card-content">
                       <div class="stats-card-number">{{ $users->where('user_type', 'teacher')->count() }}</div>
                       <div class="stats-card-label">إجمالي المدرسين</div>
                       <div class="stats-card-change">
                           <i class="icon-arrow-up5 text-success"></i>
                           <span class="text-success">+5%</span>
                           <span class="text-muted">من الشهر الماضي</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-12 col-sm-6 col-xl-3">
               <div class="stats-card stats-card-warning">
                   <div class="stats-card-icon">
                       <i class="icon-pointer"></i>
                   </div>
                   <div class="stats-card-content">
                       <div class="stats-card-number">{{ $users->where('user_type', 'admin')->count() }}</div>
                       <div class="stats-card-label">إجمالي الإداريين</div>
                       <div class="stats-card-change">
                           <i class="icon-arrow-up5 text-success"></i>
                           <span class="text-success">+2%</span>
                           <span class="text-muted">من الشهر الماضي</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-12 col-sm-6 col-xl-3">
               <div class="stats-card stats-card-info">
                   <div class="stats-card-icon">
                       <i class="icon-user"></i>
                   </div>
                   <div class="stats-card-content">
                       <div class="stats-card-number">{{ $users->where('user_type', 'parent')->count() }}</div>
                       <div class="stats-card-label">إجمالي أولياء الأمور</div>
                       <div class="stats-card-change">
                           <i class="icon-arrow-up5 text-success"></i>
                           <span class="text-success">+8%</span>
                           <span class="text-muted">من الشهر الماضي</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <!-- Quick Actions Grid -->
       <div class="row mb-4 dashboard-actions">
           <div class="col-12 col-sm-6 col-md-3">
               <div class="action-card action-card-primary">
                   <div class="action-card-icon">
                       <i class="icon-users4"></i>
                   </div>
                   <div class="action-card-content">
                       <h6 class="action-card-title">إدارة الطلاب</h6>
                       <p class="action-card-description">إضافة وتعديل وإدارة بيانات الطلاب</p>
                       <a href="{{ route('users.index') }}" class="action-card-btn">
                           <span>عرض الطلاب</span>
                           <i class="icon-arrow-left8"></i>
                       </a>
                   </div>
               </div>
           </div>
           
           <div class="col-12 col-sm-6 col-md-3">
               <div class="action-card action-card-success">
                   <div class="action-card-icon">
                       <i class="icon-users2"></i>
                   </div>
                   <div class="action-card-content">
                       <h6 class="action-card-title">إدارة المدرسين</h6>
                       <p class="action-card-description">إدارة المدرسين والموظفين</p>
                       <a href="{{ route('users.index') }}" class="action-card-btn">
                           <span>عرض المدرسين</span>
                           <i class="icon-arrow-left8"></i>
                       </a>
                   </div>
               </div>
           </div>
           
           <div class="col-12 col-sm-6 col-md-3">
               <div class="action-card action-card-warning">
                   <div class="action-card-icon">
                       <i class="icon-windows2"></i>
                   </div>
                   <div class="action-card-content">
                       <h6 class="action-card-title">إدارة الفصول</h6>
                       <p class="action-card-description">إدارة الفصول الدراسية والبرامج</p>
                       <a href="{{ route('classes.index') }}" class="action-card-btn">
                           <span>عرض الفصول</span>
                           <i class="icon-arrow-left8"></i>
                       </a>
                   </div>
               </div>
           </div>
           
           <div class="col-12 col-sm-6 col-md-3">
               <div class="action-card action-card-info">
                   <div class="action-card-icon">
                       <i class="icon-books"></i>
                   </div>
                   <div class="action-card-content">
                       <h6 class="action-card-title">إدارة الامتحانات</h6>
                       <p class="action-card-description">إنشاء وإدارة الامتحانات والدرجات</p>
                       <a href="{{ route('exams.index') }}" class="action-card-btn">
                           <span>عرض الامتحانات</span>
                           <i class="icon-arrow-left8"></i>
                       </a>
                   </div>
               </div>
           </div>
       </div>
       @else
       <!-- Fallback for non-team users -->
       <div class="alert alert-warning">
           <h5>مرحباً بك في لوحة التحكم</h5>
           <p>أنت مسجل الدخول كـ: <strong>{{ Auth::user()->user_type ?? 'مستخدم' }}</strong></p>
           <p>هذه الصفحة متاحة لأعضاء الفريق الأكاديمي والإداري.</p>
       </div>
       @endif

    <!-- Calendar and Activities Section -->
    <div class="row dashboard-main-content">
        <!-- Calendar Section -->
        <div class="col-12 col-lg-8">
            <div class="dashboard-card dashboard-calendar">
                <div class="dashboard-card-header">
                    <h5 class="dashboard-card-title">
                        <i class="icon-calendar3 mr-2"></i>
                        تقويم الأحداث الجامعية
                    </h5>
                    <div class="dashboard-card-actions">
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="icon-plus2 mr-1"></i>
                            إضافة حدث
                        </button>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="fullcalendar-basic"></div>
                </div>
            </div>
        </div>

        <!-- Recent Activities Section -->
        <div class="col-12 col-lg-4">
            <div class="dashboard-card dashboard-activities">
                <div class="dashboard-card-header">
                    <h5 class="dashboard-card-title">
                        <i class="icon-history mr-2"></i>
                        الأنشطة الأخيرة
                    </h5>
                    <div class="dashboard-card-actions">
                        <a href="#" class="btn btn-sm btn-outline-primary">عرض الكل</a>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="activity-timeline">
                        <div class="activity-item activity-item-primary">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <h6 class="activity-title">تم إضافة طالب جديد</h6>
                                <p class="activity-description">تم تسجيل طالب جديد في النظام</p>
                                <div class="activity-meta">
                                    <span class="activity-time">منذ ساعتين</span>
                                    <span class="activity-user">بواسطة أحمد محمد</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item activity-item-success">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <h6 class="activity-title">تم إنشاء امتحان جديد</h6>
                                <p class="activity-description">تم إضافة امتحان الرياضيات للفصل الأول</p>
                                <div class="activity-meta">
                                    <span class="activity-time">منذ 4 ساعات</span>
                                    <span class="activity-user">بواسطة فاطمة علي</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="activity-item activity-item-warning">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <h6 class="activity-title">تم تحديث الدرجات</h6>
                                <p class="activity-description">تم تحديث درجات الفصل الثاني</p>
                                <div class="activity-meta">
                                    <span class="activity-time">منذ 6 ساعات</span>
                                    <span class="activity-user">بواسطة محمد أحمد</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="dashboard-card dashboard-notifications">
                <div class="dashboard-card-header">
                    <h5 class="dashboard-card-title">
                        <i class="icon-bell2 mr-2"></i>
                        الإشعارات المهمة
                    </h5>
                    <div class="dashboard-card-actions">
                        <button class="btn btn-sm btn-outline-primary">تحديد الكل كمقروء</button>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="notifications-grid">
                        <div class="notification-item notification-item-primary">
                            <div class="notification-icon">
                                <i class="icon-users4"></i>
                            </div>
                            <div class="notification-content">
                                <h6 class="notification-title">اجتماع هيئة التدريس</h6>
                                <p class="notification-description">اجتماع هيئة التدريس غداً الساعة 10:00 صباحاً في القاعة الرئيسية</p>
                                <div class="notification-meta">
                                    <span class="notification-time">غداً الساعة 10:00 صباحاً</span>
                                    <span class="notification-priority">عالية</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="notification-item notification-item-warning">
                            <div class="notification-icon">
                                <i class="icon-file-text"></i>
                            </div>
                            <div class="notification-content">
                                <h6 class="notification-title">موعد تسليم التقارير</h6>
                                <p class="notification-description">موعد تسليم تقارير الفصل الدراسي خلال 3 أيام</p>
                                <div class="notification-meta">
                                    <span class="notification-time">خلال 3 أيام</span>
                                    <span class="notification-priority">متوسطة</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="notification-item notification-item-info">
                            <div class="notification-icon">
                                <i class="icon-calendar3"></i>
                            </div>
                            <div class="notification-content">
                                <h6 class="notification-title">بداية الفصل الدراسي</h6>
                                <p class="notification-description">بداية الفصل الدراسي الجديد في الأسبوع القادم</p>
                                <div class="notification-meta">
                                    <span class="notification-time">الأسبوع القادم</span>
                                    <span class="notification-priority">منخفضة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Dashboard -->
    <style>
        /* Dashboard Hero Section */
        .dashboard-hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        
        .dashboard-hero-content {
            position: relative;
            z-index: 2;
        }
        
        .dashboard-hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .dashboard-hero-subtitle {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        
        .dashboard-hero-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .dashboard-hero-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .dashboard-hero-avatar {
            text-align: center;
        }
        
        .dashboard-hero-avatar img {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 0.5rem;
        }
        
        .dashboard-hero-status {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            margin-left: 0.5rem;
        }
        
        /* Statistics Cards */
        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color) 0%, var(--color-light) 100%);
        }
        
        .stats-card-primary::before { --color: #3b82f6; --color-light: #60a5fa; }
        .stats-card-success::before { --color: #10b981; --color-light: #34d399; }
        .stats-card-warning::before { --color: #f59e0b; --color-light: #fbbf24; }
        .stats-card-info::before { --color: #8b5cf6; --color-light: #a855f7; }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stats-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--color) 0%, var(--color-light) 100%);
            color: white;
            font-size: 1.5rem;
        }
        
        .stats-card-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .stats-card-label {
            font-size: 1rem;
            color: #64748b;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .stats-card-change {
            font-size: 0.875rem;
        }
        
        /* Action Cards */
        .action-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .action-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--color) 0%, var(--color-light) 100%);
            color: white;
            font-size: 1.5rem;
        }
        
        .action-card-primary .action-card-icon { --color: #3b82f6; --color-light: #60a5fa; }
        .action-card-success .action-card-icon { --color: #10b981; --color-light: #34d399; }
        .action-card-warning .action-card-icon { --color: #f59e0b; --color-light: #fbbf24; }
        .action-card-info .action-card-icon { --color: #8b5cf6; --color-light: #a855f7; }
        
        .action-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .action-card-description {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }
        
        .action-card-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, var(--color) 0%, var(--color-light) 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .action-card-btn:hover {
            transform: translateX(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: white;
            text-decoration: none;
        }
        
        /* Dashboard Cards */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
            margin-bottom: 1.5rem;
        }
        
        .dashboard-card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .dashboard-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .dashboard-card-body {
            padding: 1.5rem;
        }
        
        /* Activity Timeline */
        .activity-timeline {
            position: relative;
        }
        
        .activity-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .activity-item:last-child {
            margin-bottom: 0;
        }
        
        .activity-marker {
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--color);
        }
        
        .activity-item-primary .activity-marker { --color: #3b82f6; }
        .activity-item-success .activity-marker { --color: #10b981; }
        .activity-item-warning .activity-marker { --color: #f59e0b; }
        
        .activity-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }
        
        .activity-description {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        
        .activity-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #94a3b8;
        }
        
        /* Notifications Grid */
        .notifications-grid {
            display: grid;
            gap: 1rem;
        }
        
        .notification-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 4px solid var(--color);
        }
        
        .notification-item-primary { --color: #3b82f6; }
        .notification-item-warning { --color: #f59e0b; }
        .notification-item-info { --color: #8b5cf6; }
        
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 1rem;
            flex-shrink: 0;
        }
        
        .notification-content {
            flex-grow: 1;
        }
        
        .notification-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }
        
        .notification-description {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        
        .notification-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
        }
        
        .notification-time {
            color: #94a3b8;
        }
        
        .notification-priority {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .notification-item-primary .notification-priority {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .notification-item-warning .notification-priority {
            background: #fef3c7;
            color: #92400e;
        }
        
        .notification-item-info .notification-priority {
            background: #ede9fe;
            color: #5b21b6;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .dashboard-hero {
                padding: 1.5rem;
                border-radius: 16px;
            }
            
            .dashboard-hero-title {
                font-size: 1.75rem;
            }
            
            .dashboard-hero-info {
                flex-direction: column;
            }
            
            .stats-card {
                padding: 1rem;
            }
            
            .stats-card-number {
                font-size: 2rem;
            }
            
            .action-card {
                padding: 1rem;
            }
            
            .dashboard-card-header {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .dashboard-card-body {
                padding: 1rem;
            }
        }
    </style>
    @endsection
