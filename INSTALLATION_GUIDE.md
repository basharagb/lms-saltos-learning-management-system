# 📦 **دليل التثبيت الشامل - نظام إدارة الطلاب الجامعي v2.0**

## 🎯 **نظرة عامة**

هذا الدليل سيساعدك في تثبيت وإعداد **نظام إدارة الطلاب الجامعي v2.0** على خادمك المحلي أو على الإنترنت. النظام مبني على Laravel 10 ويوفر دعم كامل للغة العربية مع تصميم متجاوب.

---

## 🛠️ **متطلبات النظام**

### **متطلبات PHP**
```
✅ PHP >= 8.1
✅ PHP Extensions:
   - BCMath PHP Extension
   - Ctype PHP Extension
   - cURL PHP Extension
   - DOM PHP Extension
   - Fileinfo PHP Extension
   - JSON PHP Extension
   - Mbstring PHP Extension
   - OpenSSL PHP Extension
   - PCRE PHP Extension
   - PDO PHP Extension
   - Tokenizer PHP Extension
   - XML PHP Extension
```

### **متطلبات قاعدة البيانات**
```
✅ MySQL >= 8.0 أو
✅ PostgreSQL >= 13 أو
✅ SQLite >= 3.0
```

### **متطلبات إضافية**
```
✅ Composer >= 2.0
✅ Node.js >= 16.0
✅ NPM >= 8.0
✅ Git
```

---

## 🚀 **خطوات التثبيت**

### **الخطوة 1: استنساخ المشروع**
```bash
# استنساخ المشروع من Git
git clone https://github.com/your-username/lav-sms.git
cd lav-sms

# أو تحميل الملف المضغوط وفك الضغط
# ثم الانتقال إلى المجلد
```

### **الخطوة 2: تثبيت التبعيات**
```bash
# تثبيت تبعيات PHP
composer install

# تثبيت تبعيات Node.js
npm install
```

### **الخطوة 3: إعداد البيئة**
```bash
# نسخ ملف البيئة
cp .env.example .env

# إنشاء مفتاح التطبيق
php artisan key:generate
```

### **الخطوة 4: تعديل ملف البيئة**
```env
# إعدادات قاعدة البيانات
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lav_sms
DB_USERNAME=your_username
DB_PASSWORD=your_password

# إعدادات التطبيق
APP_NAME="نظام إدارة الطلاب الجامعي"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# إعدادات البريد الإلكتروني (اختياري)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### **الخطوة 5: إعداد قاعدة البيانات**
```bash
# إنشاء قاعدة البيانات
mysql -u root -p
CREATE DATABASE lav_sms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# تشغيل الترحيلات
php artisan migrate

# تشغيل البذور (Seeders)
php artisan db:seed
```

### **الخطوة 6: تجميع الأصول**
```bash
# للتطوير
npm run dev

# للإنتاج
npm run build
```

### **الخطوة 7: اختبار النظام**
```bash
# تشغيل الخادم المحلي
php artisan serve

# فتح المتصفح على
# http://localhost:8000
```

---

## 🔑 **بيانات تسجيل الدخول الافتراضية**

بعد تشغيل البذور، يمكنك تسجيل الدخول باستخدام:

| نوع الحساب | اسم المستخدم | البريد الإلكتروني | كلمة المرور |
|------------|-------------|------------------|-------------|
| **المدير العام** | cj | cj@cj.com | cj |
| **مدير** | admin | admin@admin.com | cj |
| **مدرس** | teacher | teacher@teacher.com | cj |
| **ولي أمر** | parent | parent@parent.com | cj |
| **محاسب** | accountant | accountant@accountant.com | cj |
| **أمين مكتبة** | librarian | librarian@librarian.com | cj |
| **طالب** | student | student@student.com | cj |

---

## 🌐 **إعداد اللغة العربية**

### **تأكد من دعم UTF-8**
```sql
-- في MySQL
ALTER DATABASE lav_sms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### **إعدادات المتصفح**
```
✅ تأكد من دعم RTL في المتصفح
✅ تأكد من تحميل الخطوط العربية
✅ تأكد من دعم UTF-8
```

---

## 📱 **اختبار الاستجابة**

### **صفحة اختبار الاستجابة**
```
http://localhost:8000/test-responsive
```

**الميزات:**
- اختبار الاستجابة على جميع الأجهزة
- اختبار اللغة العربية
- اختبار الجداول والنماذج
- مؤشرات الاستجابة والأبعاد

### **اختبار على الأجهزة المختلفة**
```
📱  الهاتف: فتح الموقع على الهاتف
📱  التابلت: فتح الموقع على الجهاز اللوحي
🖥️  الكمبيوتر: فتح الموقع على الكمبيوتر
```

---

## 🔧 **إعدادات إضافية**

### **إعدادات التخزين المؤقت**
```bash
# تنظيف التخزين المؤقت
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# إعادة تحميل التكوين
php artisan config:cache
php artisan route:cache
```

### **إعدادات الأمان**
```bash
# إنشاء مفتاح التطبيق
php artisan key:generate

# تشفير البيانات
php artisan encrypt:generate
```

### **إعدادات الأداء**
```bash
# تحسين قاعدة البيانات
php artisan migrate:optimize

# تنظيف الملفات المؤقتة
php artisan optimize:clear
```

---

## 🚨 **استكشاف الأخطاء**

### **مشاكل شائعة**

#### **1. خطأ في قاعدة البيانات**
```bash
# تأكد من إعدادات قاعدة البيانات
php artisan migrate:status

# إعادة تشغيل الترحيلات
php artisan migrate:refresh --seed
```

#### **2. خطأ في الخطوط العربية**
```bash
# تأكد من تحميل الخطوط
# Cairo و Tajawal متوفرة في النظام
```

#### **3. خطأ في الاستجابة**
```bash
# تأكد من تحميل CSS و JavaScript
npm run build

# تنظيف التخزين المؤقت
php artisan view:clear
```

#### **4. خطأ في الصلاحيات**
```bash
# تأكد من صلاحيات المجلدات
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

---

## 📊 **اختبار النظام**

### **اختبار الوظائف الأساسية**
```
✅ تسجيل الدخول
✅ عرض لوحة التحكم
✅ إدارة الطلاب
✅ إدارة الدرجات
✅ إدارة المقررات
✅ إدارة المستخدمين
```

### **اختبار الاستجابة**
```
✅ الهواتف الصغيرة (< 576px)
✅ الهواتف (576px - 767px)
✅ الأجهزة اللوحية (768px - 991px)
✅ أجهزة الكمبيوتر (≥ 992px)
```

### **اختبار اللغة العربية**
```
✅ جميع النصوص بالعربية
✅ دعم RTL
✅ الخطوط العربية
✅ رسائل الخطأ العربية
```

---

## 🌍 **النشر على الإنترنت**

### **متطلبات الخادم**
```
✅ PHP >= 8.1
✅ MySQL >= 8.0
✅ Apache/Nginx
✅ SSL Certificate
✅ Domain Name
```

### **خطوات النشر**
```bash
# 1. رفع الملفات إلى الخادم
# 2. تثبيت التبعيات
composer install --optimize-autoloader --no-dev

# 3. إعداد البيئة
cp .env.example .env
# تعديل الإعدادات

# 4. إعداد قاعدة البيانات
php artisan migrate --force

# 5. تجميع الأصول
npm run build

# 6. تحسين الأداء
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📚 **الموارد الإضافية**

### **الوثائق الرسمية**
- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [DataTables Documentation](https://datatables.net/)

### **الدعم والمساعدة**
- [GitHub Issues](https://github.com/your-username/lav-sms/issues)
- [Documentation Wiki](https://github.com/your-username/lav-sms/wiki)
- [Community Forum](https://forum.your-domain.com)

---

## 🎯 **الخطوات التالية**

### **بعد التثبيت**
1. **تخصيص النظام**: تعديل الألوان والشعار
2. **إضافة البيانات**: إدخال بيانات الطلاب والمدرسين
3. **إعداد الصلاحيات**: تخصيص صلاحيات المستخدمين
4. **اختبار شامل**: اختبار جميع الوظائف
5. **النشر**: نشر النظام على الإنترنت

### **التطوير المستقبلي**
- [ ] إضافة ميزات جديدة
- [ ] تحسين الأداء
- [ ] دعم لغات إضافية
- [ ] تطوير تطبيق موبايل

---

## 🌟 **الخلاصة**

باتباع هذا الدليل، ستتمكن من تثبيت وإعداد **نظام إدارة الطلاب الجامعي v2.0** بنجاح. النظام سيوفر لك:

✅ **واجهة عربية متكاملة** مع دعم كامل للغة العربية  
✅ **تصميم متجاوب بالكامل** يعمل على جميع الأجهزة  
✅ **ميزات إدارية متقدمة** لإدارة شاملة للعملية التعليمية  
✅ **أمان وأداء محسن** لضمان تجربة مستخدم مثالية  

---

**تاريخ التحديث**: {{ date('Y-m-d') }}  
**الإصدار**: 2.0 - متجاوب ومترجم بالكامل  
**المطور**: نظام إدارة الطلاب الجامعي

**للمساعدة والدعم**: [contact@your-domain.com](mailto:contact@your-domain.com)
