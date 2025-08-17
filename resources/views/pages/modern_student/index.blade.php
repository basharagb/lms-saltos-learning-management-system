@extends('layouts.master')
@section('page_title', 'إدارة الطلاب الحديثة')
@section('content')

<style>
.modern-student-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #e3f2fd;
}

.modern-student-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(30, 58, 138, 0.15);
}

.student-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 4px solid #e3f2fd;
    object-fit: cover;
}

.student-info h5 {
    color: #1e3a8a;
    font-weight: 600;
    margin-bottom: 5px;
}

.student-badge {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.filter-card {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: 15px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.search-input {
    border-radius: 25px;
    border: 2px solid #e2e8f0;
    padding: 12px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.modern-btn {
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
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

.bulk-actions {
    background: #fef3c7;
    border: 1px solid #f59e0b;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    display: none;
}

.student-checkbox {
    transform: scale(1.2);
    margin-left: 10px;
}

.loading-spinner {
    display: none;
    text-align: center;
    padding: 40px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.empty-state i {
    font-size: 4rem;
    color: #d1d5db;
    margin-bottom: 20px;
}
</style>

<div class="content">
    <!-- Header Section -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-graduation2 mr-2"></i> إدارة الطلاب الحديثة</h4>
            </div>
            <div class="header-elements">
                @if(Qs::userIsTeamSA())
                <a href="{{ route('modern_students.create') }}" class="btn btn-primary-modern modern-btn">
                    <i class="icon-plus2 mr-2"></i> إضافة طالب جديد
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card filter-card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('modern_students.index') }}" id="filter-form">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label font-weight-semibold">البرنامج الأكاديمي</label>
                        <select name="class_id" id="class_id" class="form-control select-search" data-placeholder="اختر البرنامج">
                            <option value="">جميع البرامج</option>
                            @foreach($my_classes as $class)
                                <option value="{{ $class->id }}" {{ $selected_class == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label font-weight-semibold">القسم</label>
                        <select name="section_id" id="section_id" class="form-control select-search" data-placeholder="اختر القسم">
                            <option value="">جميع الأقسام</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ $selected_section == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label font-weight-semibold">البحث</label>
                        <input type="text" name="search" class="form-control search-input" 
                               placeholder="ابحث بالاسم، رقم القبول، أو البريد الإلكتروني..." 
                               value="{{ $search_term }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary-modern modern-btn w-100">
                            <i class="icon-search4 mr-2"></i> بحث
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bulk Actions -->
    <div class="bulk-actions" id="bulk-actions">
        <div class="d-flex justify-content-between align-items-center">
            <span><strong id="selected-count">0</strong> طالب محدد</span>
            <div>
                @if(Qs::userIsSuperAdmin())
                <button type="button" class="btn btn-danger modern-btn" onclick="bulkDelete()">
                    <i class="icon-trash mr-2"></i> حذف المحدد
                </button>
                @endif
                <button type="button" class="btn btn-secondary modern-btn" onclick="clearSelection()">
                    <i class="icon-cross2 mr-2"></i> إلغاء التحديد
                </button>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loading-spinner">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">جاري التحميل...</span>
        </div>
        <p class="mt-3">جاري تحميل بيانات الطلاب...</p>
    </div>

    <!-- Students Grid -->
    <div id="students-container">
        @if($students->count() > 0)
            <div class="row" id="students-grid">
                @foreach($students as $student)
                    <div class="col-lg-4 col-md-6 mb-4 student-item">
                        <div class="modern-student-card p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    @if(Qs::userIsSuperAdmin())
                                    <input type="checkbox" class="student-checkbox" value="{{ Qs::hash($student->id) }}" 
                                           onchange="updateBulkActions()">
                                    @endif
                                    <img src="{{ $student->user->photo }}" alt="صورة الطالب" class="student-avatar mr-3">
                                    <div class="student-info">
                                        <h5 class="mb-1">{{ $student->user->name }}</h5>
                                        <p class="text-muted mb-1">{{ $student->adm_no }}</p>
                                        <span class="student-badge">{{ $student->my_class->name }} - {{ $student->section->name }}</span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('modern_students.show', Qs::hash($student->id)) }}" class="dropdown-item">
                                            <i class="icon-eye mr-2"></i> عرض الملف الشخصي
                                        </a>
                                        @if(Qs::userIsTeamSA())
                                        <a href="{{ route('students.edit', Qs::hash($student->id)) }}" class="dropdown-item">
                                            <i class="icon-pencil mr-2"></i> تعديل
                                        </a>
                                        <a href="{{ route('st.reset_pass', Qs::hash($student->user->id)) }}" class="dropdown-item">
                                            <i class="icon-lock mr-2"></i> إعادة تعيين كلمة المرور
                                        </a>
                                        @endif
                                        <a href="{{ route('marks.year_selector', Qs::hash($student->user->id)) }}" class="dropdown-item" target="_blank">
                                            <i class="icon-file-text mr-2"></i> كشف الدرجات
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="student-details">
                                <div class="row text-sm">
                                    <div class="col-6">
                                        <strong>البريد الإلكتروني:</strong><br>
                                        <span class="text-muted">{{ $student->user->email ?: 'غير محدد' }}</span>
                                    </div>
                                    <div class="col-6">
                                        <strong>رقم الهاتف:</strong><br>
                                        <span class="text-muted">{{ $student->user->phone ?: 'غير محدد' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="icon-users4"></i>
                <h4>لا توجد نتائج</h4>
                <p>لم يتم العثور على طلاب مطابقين لمعايير البحث المحددة.</p>
                @if(Qs::userIsTeamSA())
                <a href="{{ route('modern_students.create') }}" class="btn btn-primary-modern modern-btn mt-3">
                    <i class="icon-plus2 mr-2"></i> إضافة أول طالب
                </a>
                @endif
            </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
// Auto-submit form on filter change
$('#class_id').on('change', function() {
    if ($(this).val()) {
        // Load sections for selected class
        loadSections($(this).val());
    } else {
        $('#section_id').html('<option value="">جميع الأقسام</option>');
    }
    $('#filter-form').submit();
});

$('#section_id').on('change', function() {
    $('#filter-form').submit();
});

// Load sections based on class selection
function loadSections(classId) {
    $.get('/modern-students/sections/' + classId, function(sections) {
        let options = '<option value="">جميع الأقسام</option>';
        sections.forEach(function(section) {
            options += `<option value="${section.id}">${section.name}</option>`;
        });
        $('#section_id').html(options);
    });
}

// Bulk actions functionality
function updateBulkActions() {
    const checked = $('.student-checkbox:checked').length;
    $('#selected-count').text(checked);
    
    if (checked > 0) {
        $('#bulk-actions').slideDown();
    } else {
        $('#bulk-actions').slideUp();
    }
}

function clearSelection() {
    $('.student-checkbox').prop('checked', false);
    updateBulkActions();
}

function bulkDelete() {
    const selectedIds = $('.student-checkbox:checked').map(function() {
        return $(this).val();
    }).get();
    
    if (selectedIds.length === 0) return;
    
    swal({
        title: "هل أنت متأكد؟",
        text: `سيتم حذف ${selectedIds.length} طالب نهائياً!`,
        icon: "warning",
        buttons: ["إلغاء", "حذف"],
        dangerMode: true
    }).then(function(willDelete) {
        if (willDelete) {
            $.post('/modern-students/bulk-delete', {
                student_ids: selectedIds,
                _token: '{{ csrf_token() }}'
            }).done(function(response) {
                if (response.success) {
                    location.reload();
                }
            });
        }
    });
}

// Search with debounce
let searchTimeout;
$('input[name="search"]').on('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function() {
        $('#filter-form').submit();
    }, 500);
});
</script>
@endsection
