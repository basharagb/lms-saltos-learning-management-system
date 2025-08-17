@extends('layouts.master')
@section('page_title', 'إدارة معلومات الطلاب الشاملة')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/modern-students-responsive.css') }}">
@endsection

@section('content')

<style>
    .student-management-header {
        background: linear-gradient(135deg, var(--university-primary) 0%, #1e40af 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
    }
    
    .filter-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }
    
    .students-table-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }
    
    .stats-card {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 12px;
        padding: 1.5rem;
        color: white;
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .filter-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .btn-filter {
        background: var(--university-primary);
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-filter:hover {
        background: #1e40af;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
    }
    
    .btn-reset {
        background: #6b7280;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-reset:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }
    
    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        margin: 1rem 0;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        padding: 0.5rem 1rem;
        margin-left: 0.5rem;
    }
    
    .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: 1px solid #d1d5db;
        color: var(--university-primary);
    }
    
    .page-link:hover {
        background: var(--university-primary);
        border-color: var(--university-primary);
        color: white;
    }
    
    .page-item.active .page-link {
        background: var(--university-primary);
        border-color: var(--university-primary);
    }

    /* Responsive Design Improvements */
    @media (max-width: 767.98px) {
        .student-management-header {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .student-management-header h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .student-management-header p {
            font-size: 0.9rem;
        }
        
        .stats-card {
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .stats-card h3 {
            font-size: 1.5rem;
        }
        
        .filter-card {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .filter-card h5 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-control {
            font-size: 1rem;
            padding: 0.75rem;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem;
        }
        
        .btn + .btn {
            margin-right: 0;
        }
        
        .students-table-card {
            padding: 1rem;
        }
        
        .students-table-card h5 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        
        .btn-group {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        
        .btn-group .btn {
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }
        
        .btn-group .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        .btn-group .btn:last-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-left-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
            margin-bottom: 0;
        }
        
        /* Mobile table improvements */
        .table-responsive {
            border: 0;
        }
        
        .table {
            font-size: 0.875rem;
        }
        
        .table td, .table th {
            padding: 0.5rem;
            white-space: nowrap;
        }
        
        /* Hide less important columns on mobile */
        .table th:nth-child(5),
        .table td:nth-child(5),
        .table th:nth-child(6),
        .table td:nth-child(6),
        .table th:nth-child(7),
        .table td:nth-child(7) {
            display: none;
        }
        
        /* Make student photo smaller on mobile */
        .table td:first-child img {
            height: 30px !important;
            width: 30px !important;
        }
        
        /* Improve dropdown menu on mobile */
        .dropdown-menu {
            position: static !important;
            float: none !important;
            width: 100% !important;
            margin-top: 0.5rem !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.25rem !important;
        }
        
        .dropdown-item {
            padding: 0.75rem 1rem !important;
            border-bottom: 1px solid #f8f9fa !important;
        }
        
        .dropdown-item:last-child {
            border-bottom: 0 !important;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991.98px) {
        .student-management-header {
            padding: 1.5rem;
        }
        
        .filter-card {
            padding: 1.25rem;
        }
        
        .students-table-card {
            padding: 1.25rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
        }
    }
    
    @media (min-width: 992px) {
        .student-management-header {
            padding: 2rem;
        }
        
        .filter-card {
            padding: 1.5rem;
        }
        
        .students-table-card {
            padding: 1.5rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
    }
    
    /* Ensure proper spacing for all screen sizes */
    .content {
        padding: 1rem;
    }
    
    @media (min-width: 768px) {
        .content {
            padding: 1.5rem;
        }
    }
    
    @media (min-width: 992px) {
        .content {
            padding: 2rem;
        }
    }
</style>

<!-- Page Header -->
<div class="student-management-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="mb-2">
                <i class="icon-users4 mr-3"></i>
                إدارة معلومات الطلاب الشاملة
            </h2>
            <p class="mb-0 opacity-90">عرض وإدارة جميع بيانات الطلاب في النظام مع إمكانيات البحث والتصفية المتقدمة</p>
        </div>
        <div class="col-md-4 text-right">
            <div class="stats-card">
                <h3 class="mb-1">{{ $total_students }}</h3>
                <p class="mb-0">إجمالي الطلاب</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters Section -->
<div class="filter-card">
    <h5 class="mb-3">
        <i class="icon-filter4 mr-2"></i>
        خيارات البحث والتصفية
    </h5>
    
    <form method="GET" action="{{ route('modern_students.index') }}" id="filterForm">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label for="class_id">البرنامج الأكاديمي:</label>
                    <select name="class_id" id="class_id" class="form-control">
                        <option value="">جميع البرامج</option>
                        @foreach($my_classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label for="section_id">الشعبة:</label>
                    <select name="section_id" id="section_id" class="form-control">
                        <option value="">جميع الشعب</option>
                        @if(isset($sections))
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="search">البحث:</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="ابحث بالاسم، رقم القيد، البريد الإلكتروني، أو رقم الهاتف..."
                           value="{{ request('search') }}">
                </div>
            </div>
            
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div class="d-flex flex-column flex-sm-row">
                        <button type="submit" class="btn btn-filter mb-2 mb-sm-0 mr-sm-2">
                            <i class="icon-search4"></i> بحث
                        </button>
                        <a href="{{ route('modern_students.index') }}" class="btn btn-reset">
                            <i class="icon-reset"></i> إعادة تعيين
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Students Table -->
<div class="students-table-card">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <h5 class="mb-2 mb-md-0">
            <i class="icon-table2 mr-2"></i>
            قائمة الطلاب
        </h5>
        
        @if(Qs::userIsTeamSA())
        <div class="btn-group w-100 w-md-auto">
            <a href="{{ route('modern_students.create') }}" class="btn btn-primary">
                <i class="icon-plus2 mr-2"></i>
                إضافة طالب جديد
            </a>
            <button type="button" class="btn btn-success" onclick="exportToExcel()">
                <i class="icon-file-excel mr-2"></i>
                تصدير إلى Excel
            </button>
        </div>
        @endif
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover datatable-button-html5-columns" id="studentsTable">
            <thead class="bg-light">
                <tr>
                    <th>الصورة</th>
                    <th>الاسم</th>
                    <th>رقم القيد</th>
                    <th>البرنامج الأكاديمي</th>
                    <th class="d-none d-md-table-cell">الشعبة</th>
                    <th class="d-none d-md-table-cell">البريد الإلكتروني</th>
                    <th class="d-none d-md-table-cell">رقم الهاتف</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    @if($student->user) {{-- Only display students with valid user records --}}
                    <tr>
                        <td>
                            <img class="rounded-circle" style="height: 40px; width: 40px;"
                                 src="{{ $student->user->photo ?? '/assets/images/default-avatar.png' }}"
                                 alt="صورة الطالب"
                                 onerror="this.src='/assets/images/default-avatar.png'">
                        </td>
                        <td>{{ $student->user->name ?? 'غير محدد' }}</td>
                        <td>{{ $student->adm_no ?? 'غير محدد' }}</td>
                        <td>{{ $student->my_class->name ?? 'غير محدد' }}</td>
                        <td class="d-none d-md-table-cell">{{ $student->section->name ?? 'غير محدد' }}</td>
                        <td class="d-none d-md-table-cell">{{ $student->user->email ?? 'غير محدد' }}</td>
                        <td class="d-none d-md-table-cell">{{ $student->user->phone ?? 'غير محدد' }}</td>
                        <td>
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <a href="{{ route('modern_students.show', $student->id) }}" class="dropdown-item">
                                            <i class="icon-eye"></i> عرض الملف الشخصي
                                        </a>
                                        @if(Qs::userIsTeamSA())
                                            <a href="{{ route('modern_students.edit', $student->id) }}" class="dropdown-item">
                                                <i class="icon-pencil"></i> تعديل
                                            </a>
                                            <a href="#" class="dropdown-item" onclick="resetPassword({{ $student->user->id }})">
                                                <i class="icon-lock"></i> إعادة تعيين كلمة المرور
                                            </a>
                                        @endif
                                        <a href="#" class="dropdown-item" onclick="viewMarks({{ $student->user->id }})">
                                            <i class="icon-check"></i> كشف الدرجات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif {{-- End of user check --}}
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Handle class selection change
    $('#class_id').change(function() {
        var classId = $(this).val();
        if (classId) {
            $.get('{{ route("modern_students.sections", ":id") }}'.replace(':id', classId), function(data) {
                $('#section_id').empty().append('<option value="">جميع الشعب</option>');
                $.each(data, function(key, section) {
                    $('#section_id').append('<option value="' + section.id + '">' + section.name + '</option>');
                });
            });
        } else {
            $('#section_id').empty().append('<option value="">جميع الشعب</option>');
        }
    });
    
    // Initialize DataTable with responsive features
    if ($.fn.DataTable) {
        $('#studentsTable').DataTable({
            responsive: true,
            language: {
                url: '/assets/js/arabic-datatables.js'
            },
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            columnDefs: [
                {
                    targets: [0, 7], // Photo and Actions columns
                    orderable: false,
                    searchable: false
                }
            ]
        });
    }
});

function exportToExcel() {
    // Trigger Excel export using the system's DataTable configuration
    $('.buttons-excel').click();
}

function resetPassword(userId) {
    if (confirm('هل أنت متأكد من إعادة تعيين كلمة المرور لهذا المستخدم؟')) {
        // Add password reset logic here
        alert('سيتم إرسال رابط إعادة تعيين كلمة المرور إلى البريد الإلكتروني');
    }
}

function viewMarks(userId) {
    // Add marks viewing logic here
    alert('سيتم فتح صفحة كشف الدرجات قريباً');
}
</script>
@endsection
