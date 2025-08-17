@extends('layouts.master')
@section('page_title', 'إدارة المقررات الدراسية')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/courses-responsive.css') }}">
@endsection

@section('content')

<style>
    .courses-management-header {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    }
    
    .filter-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }
    
    .courses-table-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }
    
    .stats-card {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 12px;
        padding: 1.5rem;
        color: white;
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .course-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        background: white;
    }
    
    .course-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .course-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .status-active {
        background: #dcfce7;
        color: #166534;
    }
    
    .status-inactive {
        background: #fef2f2;
        color: #991b1b;
    }
    
    .semester-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #f3f4f6;
        color: #374151;
    }
</style>

<!-- Page Header -->
<div class="courses-management-header">
    <div class="row align-items-center">
        <div class="col-md-8 col-sm-12">
            <h2 class="mb-2">
                <i class="icon-books mr-3"></i>
                إدارة المقررات الدراسية
            </h2>
            <p class="mb-0 opacity-90">إدارة شاملة لجميع المقررات الدراسية مع إمكانيات التسجيل والمتابعة</p>
        </div>
        <div class="col-md-4 col-sm-12 text-center text-md-right">
            <div class="stats-card">
                <h3 class="mb-1">{{ $total_courses }}</h3>
                <p class="mb-0">إجمالي المقررات</p>
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
    
    <form method="GET" action="{{ route('courses.index') }}" id="filterForm">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-12">
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
            
            <div class="col-md-2 col-sm-6 col-12">
                <div class="form-group">
                    <label for="semester">الفصل الدراسي:</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="">جميع الفصول</option>
                        <option value="first" {{ request('semester') == 'first' ? 'selected' : '' }}>الأول</option>
                        <option value="second" {{ request('semester') == 'second' ? 'selected' : '' }}>الثاني</option>
                        <option value="summer" {{ request('semester') == 'summer' ? 'selected' : '' }}>الصيفي</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-2 col-sm-6 col-12">
                <div class="form-group">
                    <label for="academic_year">السنة الأكاديمية:</label>
                    <input type="text" name="academic_year" id="academic_year" class="form-control" 
                           placeholder="2023-2024" value="{{ request('academic_year') }}">
                </div>
            </div>
            
            <div class="col-md-2 col-sm-6 col-12">
                <div class="form-group">
                    <label for="status">الحالة:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">جميع الحالات</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-12">
                <div class="form-group">
                    <label for="search">البحث:</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="ابحث بالاسم أو الرمز أو الوصف..."
                           value="{{ request('search') }}">
                </div>
            </div>
            
            <div class="col-md-1 col-sm-6 col-12">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div class="d-flex flex-column flex-sm-row">
                        <button type="submit" class="btn btn-primary mb-2 mb-sm-0 mr-sm-2">
                            <i class="icon-search4"></i>
                        </button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                            <i class="icon-reset"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Courses Table -->
<div class="courses-table-card">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <h5 class="mb-2 mb-md-0">
            <i class="icon-table2 mr-2"></i>
            قائمة المقررات
        </h5>
        
        @if(Qs::userIsTeamSA())
        <div class="btn-group w-100 w-md-auto">
            <a href="{{ route('courses.create') }}" class="btn btn-success">
                <i class="icon-plus2 mr-2"></i>
                إضافة مقرر جديد
            </a>
        </div>
        @endif
    </div>
    
    <div class="row">
        @forelse($courses as $course)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="course-card">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-3">
                    <div class="mb-2 mb-sm-0">
                        <h6 class="mb-1 font-weight-bold">{{ $course->name }}</h6>
                        <p class="text-muted mb-0">{{ $course->code }}</p>
                    </div>
                    <span class="course-status {{ $course->status == 'active' ? 'status-active' : 'status-inactive' }}">
                        {{ $course->status == 'active' ? 'نشط' : 'غير نشط' }}
                    </span>
                </div>
                
                <div class="mb-3">
                    <p class="text-muted mb-2">{{ \Illuminate\Support\Str::limit($course->description, 100) }}</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                        <span class="semester-badge mb-2 mb-sm-0">
                            @if($course->semester == 'first') الفصل الأول
                            @elseif($course->semester == 'second') الفصل الثاني
                            @else الفصل الصيفي
                            @endif
                        </span>
                        <small class="text-muted">{{ $course->credit_hours }} ساعة معتمدة</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted d-block">البرنامج: {{ $course->myClass->name ?? 'غير محدد' }}</small>
                    <small class="text-muted d-block">المدرس: {{ $course->teacher->name ?? 'غير محدد' }}</small>
                    <small class="text-muted d-block">السنة الأكاديمية: {{ $course->academic_year }}</small>
                    <small class="text-muted d-block">الطلاب المسجلون: {{ $course->enrollments->count() }}</small>
                </div>
                
                <div class="d-flex flex-column flex-sm-row justify-content-between">
                    <div class="btn-group btn-group-sm mb-2 mb-sm-0">
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary">
                            <i class="icon-eye"></i> عرض
                        </a>
                        @if(Qs::userIsTeamSA())
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-warning">
                            <i class="icon-pencil"></i> تعديل
                        </a>
                        @endif
                    </div>
                    <a href="{{ route('courses.enrollments', $course->id) }}" class="btn btn-sm btn-outline-success">
                        <i class="icon-users"></i> التسجيلات
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="icon-books display-4 text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد مقررات</h5>
                <p class="text-muted">لم يتم العثور على أي مقررات تطابق معايير البحث</p>
                @if(Qs::userIsTeamSA())
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="icon-plus2 mr-2"></i>
                    إضافة مقرر جديد
                </a>
                @endif
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto-submit form on filter change
    $('#class_id, #semester, #status').change(function() {
        $('#filterForm').submit();
    });
});
</script>
@endsection
