@extends('layouts.master')
@section('page_title', 'تعديل المقرر - ' . $course->name)
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">تعديل المقرر</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">اسم المقرر <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name', $course->name) }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">رمز المقرر <span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control" 
                               value="{{ old('code', $course->code) }}" placeholder="مثال: CS101" required>
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">وصف المقرر</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="credit_hours">الساعات المعتمدة <span class="text-danger">*</span></label>
                        <select name="credit_hours" id="credit_hours" class="form-control" required>
                            <option value="">اختر الساعات المعتمدة</option>
                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ old('credit_hours', $course->credit_hours) == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i == 1 ? 'ساعة' : 'ساعات' }}
                                </option>
                            @endfor
                        </select>
                        @error('credit_hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="my_class_id">البرنامج الأكاديمي <span class="text-danger">*</span></label>
                        <select name="my_class_id" id="my_class_id" class="form-control" required>
                            <option value="">اختر البرنامج الأكاديمي</option>
                            @foreach($my_classes as $class)
                                <option value="{{ $class->id }}" {{ old('my_class_id', $course->my_class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('my_class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="teacher_id">المدرس</label>
                        <select name="teacher_id" id="teacher_id" class="form-control">
                            <option value="">اختر المدرس</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">الفصل الدراسي <span class="text-danger">*</span></label>
                        <select name="semester" id="semester" class="form-control" required>
                            <option value="">اختر الفصل الدراسي</option>
                            <option value="first" {{ old('semester', $course->semester) == 'first' ? 'selected' : '' }}>الفصل الأول</option>
                            <option value="second" {{ old('semester', $course->semester) == 'second' ? 'selected' : '' }}>الفصل الثاني</option>
                            <option value="summer" {{ old('semester', $course->semester) == 'summer' ? 'selected' : '' }}>الفصل الصيفي</option>
                        </select>
                        @error('semester')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="academic_year">السنة الأكاديمية <span class="text-danger">*</span></label>
                        <input type="text" name="academic_year" id="academic_year" class="form-control" 
                               value="{{ old('academic_year', $course->academic_year) }}" placeholder="2023-2024" required>
                        @error('academic_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">الحالة <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">اختر الحالة</option>
                            <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">تحديث المقرر <i class="icon-paperplane ml-2"></i></button>
                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>

@endsection
