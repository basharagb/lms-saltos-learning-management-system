@extends('layouts.master')
@section('page_title', 'الملف الشخصي للطالب - ' . $sr->user->name)
@section('content')

<style>
.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    color: white;
    padding: 40px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="10" cy="50" r="1" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.3);
    object-fit: cover;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.info-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e3f2fd;
    margin-bottom: 25px;
    overflow: hidden;
}

.info-card-header {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    padding: 20px;
    border-bottom: 1px solid #e2e8f0;
}

.info-card-header h5 {
    color: #1e3a8a;
    font-weight: 600;
    margin: 0;
}

.info-row {
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #475569;
    min-width: 140px;
    margin-left: 15px;
}

.info-value {
    color: #1e293b;
    flex: 1;
}

.status-badge {
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.action-buttons {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 25px;
    margin-bottom: 25px;
}

.modern-btn {
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    margin-left: 10px;
    margin-bottom: 10px;
}

.btn-primary-modern {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
}

.btn-primary-modern:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-success-modern {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-warning-modern {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.btn-danger-modern {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.academic-progress {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
}

.progress-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.progress-bar-custom {
    height: 8px;
    border-radius: 10px;
    background: #e5e7eb;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    border-radius: 10px;
    transition: width 0.3s ease;
}
</style>

<div class="content">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('modern_students.index') }}" class="btn btn-light modern-btn">
            <i class="icon-arrow-right8 mr-2"></i> العودة إلى قائمة الطلاب
        </a>
    </div>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="row align-items-center position-relative">
            <div class="col-md-3 text-center">
                <img src="{{ $sr->user->photo }}" alt="صورة الطالب" class="profile-avatar">
            </div>
            <div class="col-md-9">
                <h2 class="mb-2">{{ $sr->user->name }}</h2>
                <p class="mb-2 opacity-90">{{ $sr->my_class->name }} - {{ $sr->section->name }}</p>
                <div class="d-flex align-items-center">
                    <span class="status-badge {{ $sr->user->email_verified_at ? 'status-active' : 'status-inactive' }}">
                        {{ $sr->user->email_verified_at ? 'نشط' : 'غير نشط' }}
                    </span>
                    <span class="mr-3 opacity-75">رقم القبول: {{ $sr->adm_no }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Personal Information -->
        <div class="col-lg-6">
            <div class="info-card">
                <div class="info-card-header">
                    <h5><i class="icon-user mr-2"></i> المعلومات الشخصية</h5>
                </div>
                <div class="card-body p-0">
                    <div class="info-row">
                        <span class="info-label">الاسم الكامل:</span>
                        <span class="info-value">{{ $sr->user->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">البريد الإلكتروني:</span>
                        <span class="info-value">{{ $sr->user->email ?: 'غير محدد' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">رقم الهاتف:</span>
                        <span class="info-value">{{ $sr->user->phone ?: 'غير محدد' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">العنوان:</span>
                        <span class="info-value">{{ $sr->user->address ?: 'غير محدد' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الجنس:</span>
                        <span class="info-value">{{ $sr->user->gender == 'Male' ? 'ذكر' : 'أنثى' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">تاريخ الميلاد:</span>
                        <span class="info-value">{{ $sr->user->dob ? date('Y/m/d', strtotime($sr->user->dob)) : 'غير محدد' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">فصيلة الدم:</span>
                        <span class="info-value">{{ $sr->user->blood_group->name ?? 'غير محدد' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="col-lg-6">
            <div class="info-card">
                <div class="info-card-header">
                    <h5><i class="icon-graduation2 mr-2"></i> المعلومات الأكاديمية</h5>
                </div>
                <div class="card-body p-0">
                    <div class="info-row">
                        <span class="info-label">رقم القبول:</span>
                        <span class="info-value">{{ $sr->adm_no }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">البرنامج الأكاديمي:</span>
                        <span class="info-value">{{ $sr->my_class->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">القسم:</span>
                        <span class="info-value">{{ $sr->section->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">سنة القبول:</span>
                        <span class="info-value">{{ $sr->year_admitted }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الجلسة الحالية:</span>
                        <span class="info-value">{{ $sr->session }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">حالة التخرج:</span>
                        <span class="info-value">
                            <span class="status-badge {{ $sr->grad ? 'status-inactive' : 'status-active' }}">
                                {{ $sr->grad ? 'متخرج' : 'طالب حالي' }}
                            </span>
                        </span>
                    </div>
                    @if($sr->house)
                    <div class="info-row">
                        <span class="info-label">السكن:</span>
                        <span class="info-value">{{ $sr->house }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    @if(Qs::userIsTeamSA())
    <div class="action-buttons">
        <h5 class="mb-3"><i class="icon-cog mr-2"></i> الإجراءات المتاحة</h5>
        <div class="d-flex flex-wrap">
            <a href="{{ route('students.edit', Qs::hash($sr->id)) }}" class="btn btn-primary-modern modern-btn">
                <i class="icon-pencil mr-2"></i> تعديل البيانات
            </a>
            <a href="{{ route('st.reset_pass', Qs::hash($sr->user->id)) }}" class="btn btn-warning-modern modern-btn">
                <i class="icon-lock mr-2"></i> إعادة تعيين كلمة المرور
            </a>
            <a href="{{ route('marks.year_selector', Qs::hash($sr->user->id)) }}" target="_blank" class="btn btn-success-modern modern-btn">
                <i class="icon-file-text mr-2"></i> كشف الدرجات
            </a>
            @if(Qs::userIsSuperAdmin())
            <button onclick="confirmDelete('{{ Qs::hash($sr->user->id) }}')" class="btn btn-danger-modern modern-btn">
                <i class="icon-trash mr-2"></i> حذف الطالب
            </button>
            <form method="post" id="item-delete-{{ Qs::hash($sr->user->id) }}" action="{{ route('students.destroy', Qs::hash($sr->id)) }}" class="d-none">
                @csrf @method('delete')
            </form>
            @endif
        </div>
    </div>
    @endif

    <!-- Academic Progress (if available) -->
    <div class="academic-progress">
        <h5 class="mb-3"><i class="icon-stats-bars mr-2"></i> التقدم الأكاديمي</h5>
        <div class="progress-item">
            <span>إجمالي المقررات المكتملة</span>
            <span class="font-weight-bold">85%</span>
        </div>
        <div class="progress-bar-custom mb-3">
            <div class="progress-fill" style="width: 85%"></div>
        </div>
        
        <div class="progress-item">
            <span>المعدل التراكمي</span>
            <span class="font-weight-bold">3.7 / 4.0</span>
        </div>
        <div class="progress-bar-custom">
            <div class="progress-fill" style="width: 92%"></div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function confirmDelete(id) {
    swal({
        title: "هل أنت متأكد؟",
        text: "سيتم حذف جميع بيانات الطالب نهائياً!",
        icon: "warning",
        buttons: ["إلغاء", "حذف"],
        dangerMode: true
    }).then(function(willDelete) {
        if (willDelete) {
            $('form#item-delete-' + id).submit();
        }
    });
}
</script>
@endsection
