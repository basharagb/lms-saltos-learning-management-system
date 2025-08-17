<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>اختبار النص العربي</title>
    
    <!-- Arabic Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
            direction: rtl;
            text-align: right;
            background: #f8fafc;
        }
        
        .test-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .arabic-text {
            font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
            font-size: 1.2rem;
            line-height: 1.8;
            color: #1f2937;
        }
        
        .test-section {
            margin-bottom: 2rem;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }
        
        .test-title {
            color: #3b82f6;
            font-weight: 600;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="test-card">
            <h1 class="text-center mb-4" style="color: #3b82f6;">اختبار النظام العربي الشامل</h1>
            
            <div class="test-section">
                <h3 class="test-title">1. اختبار النصوص العربية الأساسية</h3>
                <p class="arabic-text">
                    مرحباً بكم في نظام إدارة الجامعة العربية. هذا النظام يدعم اللغة العربية بشكل كامل مع التوجه من اليمين إلى اليسار.
                </p>
            </div>
            
            <div class="test-section">
                <h3 class="test-title">2. اختبار المصطلحات الجامعية</h3>
                <ul class="arabic-text">
                    <li>إدارة معلومات الطلاب الشاملة</li>
                    <li>البرامج الأكاديمية والشعب الدراسية</li>
                    <li>البحث والتصفية المتقدمة</li>
                    <li>تصدير البيانات وطباعة التقارير</li>
                    <li>إعادة تعيين كلمة المرور</li>
                </ul>
            </div>
            
            <div class="test-section">
                <h3 class="test-title">3. اختبار النماذج والحقول</h3>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">الاسم الكامل:</label>
                            <input type="text" class="form-control" placeholder="أدخل الاسم الكامل">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">البريد الإلكتروني:</label>
                            <input type="email" class="form-control" placeholder="أدخل البريد الإلكتروني">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">البرنامج الأكاديمي:</label>
                            <select class="form-control">
                                <option>اختر البرنامج</option>
                                <option>علوم الحاسوب</option>
                                <option>الهندسة المدنية</option>
                                <option>إدارة الأعمال</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">الشعبة:</label>
                            <select class="form-control">
                                <option>اختر الشعبة</option>
                                <option>الشعبة أ</option>
                                <option>الشعبة ب</option>
                                <option>الشعبة ج</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary me-2">حفظ البيانات</button>
                        <button type="button" class="btn btn-secondary">إلغاء</button>
                    </div>
                </form>
            </div>
            
            <div class="test-section">
                <h3 class="test-title">4. اختبار الجدول العربي</h3>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>الرقم</th>
                            <th>اسم الطالب</th>
                            <th>رقم القيد</th>
                            <th>البرنامج</th>
                            <th>الشعبة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>أحمد محمد علي</td>
                            <td>2024001</td>
                            <td>علوم الحاسوب</td>
                            <td>الشعبة أ</td>
                            <td>
                                <button class="btn btn-sm btn-primary">عرض</button>
                                <button class="btn btn-sm btn-warning">تعديل</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>فاطمة أحمد حسن</td>
                            <td>2024002</td>
                            <td>إدارة الأعمال</td>
                            <td>الشعبة ب</td>
                            <td>
                                <button class="btn btn-sm btn-primary">عرض</button>
                                <button class="btn btn-sm btn-warning">تعديل</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="test-section">
                <h3 class="test-title">5. نتيجة الاختبار</h3>
                <div class="alert alert-success arabic-text">
                    ✅ تم اختبار النظام بنجاح! جميع النصوص العربية تظهر بشكل صحيح مع التوجه من اليمين إلى اليسار.
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
