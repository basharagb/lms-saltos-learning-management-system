<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>اختبار الاستجابة واللغة العربية</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/university-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/global-responsive.css') }}" rel="stylesheet">
    
    <style>
        .test-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background: white;
        }
        
        .test-title {
            color: #1e3a8a;
            border-bottom: 2px solid #e3f2fd;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .responsive-demo {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .language-demo {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-none d-md-block">
                <div class="sidebar bg-dark text-white p-3" style="min-height: 100vh;">
                    <h5 class="mb-3">القائمة الجانبية</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#responsive">اختبار الاستجابة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#language">اختبار اللغة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#tables">اختبار الجداول</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#forms">اختبار النماذج</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="content p-4">
                    <h1 class="text-center mb-4">اختبار الاستجابة واللغة العربية</h1>
                    
                    <!-- Responsiveness Test Section -->
                    <div id="responsive" class="test-section">
                        <h3 class="test-title">📱 اختبار الاستجابة</h3>
                        <div class="responsive-demo">
                            <h5>اختبار تخطيط الشبكة</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h6>عمود 1</h6>
                                            <small>يجب أن يتكيف مع جميع الأحجام</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h6>عمود 2</h6>
                                            <small>يجب أن يتكيف مع جميع الأحجام</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h6>عمود 3</h6>
                                            <small>يجب أن يتكيف مع جميع الأحجام</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h6>عمود 4</h6>
                                            <small>يجب أن يتكيف مع جميع الأحجام</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="responsive-demo">
                            <h5>اختبار الأزرار</h5>
                            <div class="btn-group mb-3">
                                <button class="btn btn-primary">زر أساسي</button>
                                <button class="btn btn-success">زر نجاح</button>
                                <button class="btn btn-warning">زر تحذير</button>
                                <button class="btn btn-danger">زر خطر</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Language Test Section -->
                    <div id="language" class="test-section">
                        <h3 class="test-title">🌐 اختبار اللغة العربية</h3>
                        <div class="language-demo">
                            <h5>النصوص العربية</h5>
                            <p>هذا نص تجريبي لاختبار اللغة العربية في النظام. يجب أن تظهر جميع النصوص باللغة العربية بشكل صحيح.</p>
                            <ul>
                                <li>النقطة الأولى: اختبار النصوص العربية</li>
                                <li>النقطة الثانية: اختبار الاتجاه من اليمين إلى اليسار</li>
                                <li>النقطة الثالثة: اختبار الخطوط العربية</li>
                            </ul>
                        </div>
                        
                        <div class="language-demo">
                            <h5>اختبار الألوان والتصميم</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-primary">
                                        <strong>تنبيه أساسي:</strong> هذا مثال على التنبيهات العربية
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <strong>تنبيه نجاح:</strong> هذا مثال على التنبيهات العربية
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tables Test Section -->
                    <div id="tables" class="test-section">
                        <h3 class="test-title">📊 اختبار الجداول</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>أحمد محمد</td>
                                        <td>ahmed@example.com</td>
                                        <td>+966501234567</td>
                                        <td><span class="badge bg-success">نشط</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    إجراءات
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">عرض</a></li>
                                                    <li><a class="dropdown-item" href="#">تعديل</a></li>
                                                    <li><a class="dropdown-item" href="#">حذف</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>فاطمة علي</td>
                                        <td>fatima@example.com</td>
                                        <td>+966507654321</td>
                                        <td><span class="badge bg-warning">معلق</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    إجراءات
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">عرض</a></li>
                                                    <li><a class="dropdown-item" href="#">تعديل</a></li>
                                                    <li><a class="dropdown-item" href="#">حذف</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Forms Test Section -->
                    <div id="forms" class="test-section">
                        <h3 class="test-title">📝 اختبار النماذج</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">الاسم الكامل</label>
                                    <input type="text" class="form-control" id="name" placeholder="أدخل الاسم الكامل">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" placeholder="أدخل البريد الإلكتروني">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="tel" class="form-control" id="phone" placeholder="أدخل رقم الهاتف">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">البلد</label>
                                    <select class="form-select" id="country">
                                        <option value="">اختر البلد</option>
                                        <option value="sa">المملكة العربية السعودية</option>
                                        <option value="ae">الإمارات العربية المتحدة</option>
                                        <option value="kw">الكويت</option>
                                        <option value="qa">قطر</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">الرسالة</label>
                                <textarea class="form-control" id="message" rows="4" placeholder="أدخل رسالتك هنا"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agree">
                                    <label class="form-check-label" for="agree">
                                        أوافق على الشروط والأحكام
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary me-md-2">إلغاء</button>
                                <button type="submit" class="btn btn-primary">إرسال</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Responsiveness Indicators -->
                    <div class="test-section">
                        <h3 class="test-title">📱 مؤشرات الاستجابة</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6>معلومات الشاشة الحالية:</h6>
                                    <p><strong>عرض الشاشة:</strong> <span id="screen-width"></span>px</p>
                                    <p><strong>نوع الجهاز:</strong> <span id="device-type"></span></p>
                                    <p><strong>اتجاه الشاشة:</strong> <span id="orientation"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Responsiveness indicators
        function updateResponsivenessInfo() {
            const width = window.innerWidth;
            const height = window.innerHeight;
            const orientation = width > height ? 'أفقي' : 'عمودي';
            
            let deviceType = 'غير محدد';
            if (width < 576) deviceType = 'هاتف صغير';
            else if (width < 768) deviceType = 'هاتف';
            else if (width < 992) deviceType = 'تابلت';
            else if (width < 1200) deviceType = 'كمبيوتر';
            else deviceType = 'كمبيوتر كبير';
            
            document.getElementById('screen-width').textContent = `${width} × ${height}`;
            document.getElementById('device-type').textContent = deviceType;
            document.getElementById('orientation').textContent = orientation;
        }
        
        // Update on load and resize
        window.addEventListener('load', updateResponsivenessInfo);
        window.addEventListener('resize', updateResponsivenessInfo);
        
        // Test RTL functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('تم تحميل الصفحة بنجاح');
            console.log('اتجاه النص:', document.dir);
            console.log('لغة الصفحة:', document.documentElement.lang);
        });
    </script>
</body>
</html>
