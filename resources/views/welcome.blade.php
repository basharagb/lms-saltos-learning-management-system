<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'نظام إدارة الطلاب') }} - البوابة الرئيسية</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #3b82f6;
            --accent-color: #60a5fa;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --text-color: #374151;
            --border-color: #e5e7eb;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background: var(--light-color);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }
        
        .btn-hero {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary-hero {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .btn-primary-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.3);
            color: var(--primary-color);
        }
        
        .btn-outline-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-outline-hero:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .features-section {
            padding: 5rem 0;
            background: white;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 3rem;
        }
        
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }
        
        .feature-description {
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .stats-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            padding: 4rem 0;
            color: white;
        }
        
        .stat-item {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .cta-section {
            background: var(--light-color);
            padding: 5rem 0;
            text-align: center;
        }
        
        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
        }
        
        .cta-description {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
            text-align: center;
        }
        
        .footer-content {
            margin-bottom: 2rem;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .footer-link {
            color: var(--accent-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-link:hover {
            color: white;
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero {
                width: 100%;
                max-width: 300px;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .feature-card {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">نظام إدارة الطلاب الجامعي</h1>
                <p class="hero-subtitle">
                    منصة متكاملة لإدارة العملية التعليمية، تمكن الطلاب والمدرسين والإداريين من الوصول إلى جميع الخدمات الأكاديمية بسهولة وكفاءة
                </p>
                
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn btn-hero btn-primary-hero">
                        <i class="fas fa-sign-in-alt ml-2"></i>
                        تسجيل الدخول
                    </a>
                    <a href="#features" class="btn btn-hero btn-outline-hero">
                        <i class="fas fa-info-circle ml-2"></i>
                        تعرف على المزيد
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="section-title">الميزات الرئيسية</h2>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">إدارة الطلاب</h3>
                        <p class="feature-description">
                            نظام متكامل لإدارة بيانات الطلاب، التسجيل، التقييم، والمتابعة الأكاديمية
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="feature-title">إدارة المدرسين</h3>
                        <p class="feature-description">
                            منصة شاملة لإدارة المدرسين، الجداول الدراسية، والتقييمات
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="feature-title">إدارة الفصول</h3>
                        <p class="feature-description">
                            إدارة الفصول الدراسية، البرامج الأكاديمية، والمناهج الدراسية
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="feature-title">إدارة الامتحانات</h3>
                        <p class="feature-description">
                            إنشاء وإدارة الامتحانات، تصحيحها، وإصدار النتائج
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">التقارير والإحصائيات</h3>
                        <p class="feature-description">
                            تقارير شاملة وإحصائيات مفصلة عن الأداء الأكاديمي
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">تصميم متجاوب</h3>
                        <p class="feature-description">
                            واجهة مستخدم متجاوبة تعمل على جميع الأجهزة والشاشات
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">طالب نشط</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">مدرس محترف</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">فصل دراسي</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">99%</div>
                        <div class="stat-label">معدل الرضا</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">ابدأ رحلتك التعليمية اليوم</h2>
            <p class="cta-description">
                انضم إلى مجتمعنا التعليمي واستفد من أحدث التقنيات في إدارة العملية التعليمية
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border: none; padding: 1rem 2rem; border-radius: 50px; font-weight: 600; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
                <i class="fas fa-rocket ml-2"></i>
                ابدأ الآن
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h4>نظام إدارة الطلاب الجامعي</h4>
                <p>منصة تعليمية متطورة تهدف إلى تسهيل العملية التعليمية</p>
            </div>
            
            <div class="footer-links">
                <a href="#" class="footer-link">سياسة الخصوصية</a>
                <a href="#" class="footer-link">شروط الاستخدام</a>
                <a href="#" class="footer-link">الدعم الفني</a>
                <a href="#" class="footer-link">تواصل معنا</a>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 نظام إدارة الطلاب الجامعي. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

