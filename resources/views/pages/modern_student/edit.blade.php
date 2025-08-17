@extends('layouts.master')
@section('page_title', 'تعديل بيانات الطالب')
@section('content')

<style>
.modern-form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    border: 1px solid #e3f2fd;
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    text-align: center;
}

.modern-input {
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 15px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafbfc;
}

.modern-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: white;
}

.modern-select {
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 15px 20px;
    font-size: 1rem;
    background: #fafbfc;
    transition: all 0.3s ease;
}

.modern-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: white;
}

.modern-btn {
    border-radius: 12px;
    padding: 15px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary-modern {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
}

.btn-primary-modern:hover {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.btn-secondary-modern {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
}

.btn-secondary-modern:hover {
    background: linear-gradient(135deg, #4b5563, #374151);
    transform: translateY(-2px);
}

.form-section {
    padding: 30px;
    border-bottom: 1px solid #e2e8f0;
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    color: #1e40af;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 1.2rem;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
}

.form-col {
    flex: 1;
    padding: 0 10px;
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
}

.required::after {
    content: " *";
    color: #ef4444;
}
</style>

<div class="modern-form-card">
    <div class="form-header">
        <h2 class="mb-2">
            <i class="icon-user-plus mr-3"></i>
            تعديل بيانات الطالب
        </h2>
        <p class="mb-0 opacity-90">تحديث المعلومات الشخصية والأكاديمية للطالب</p>
    </div>

    <form method="POST" action="{{ route('modern_students.update', $student->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Personal Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="icon-user mr-2"></i>
                المعلومات الشخصية
            </h3>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="name" class="required">الاسم الكامل</label>
                        <input type="text" id="name" name="name" class="modern-input w-100" 
                               value="{{ old('name', $student->user->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label for="email" class="required">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" class="modern-input w-100" 
                               value="{{ old('email', $student->user->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="text" id="phone" name="phone" class="modern-input w-100" 
                               value="{{ old('phone', $student->user->phone) }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label for="gender">الجنس</label>
                        <select id="gender" name="gender" class="modern-select w-100">
                            <option value="">اختر الجنس</option>
                            <option value="Male" {{ old('gender', $student->user->gender) == 'Male' ? 'selected' : '' }}>ذكر</option>
                            <option value="Female" {{ old('gender', $student->user->gender) == 'Female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="icon-graduation mr-2"></i>
                المعلومات الأكاديمية
            </h3>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="my_class_id" class="required">البرنامج الأكاديمي</label>
                        <select id="my_class_id" name="my_class_id" class="modern-select w-100" required>
                            <option value="">اختر البرنامج</option>
                            @foreach($my_classes as $class)
                                <option value="{{ $class->id }}" {{ old('my_class_id', $student->my_class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('my_class_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label for="section_id" class="required">الشعبة</label>
                        <select id="section_id" name="section_id" class="modern-select w-100" required>
                            <option value="">اختر الشعبة</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id', $student->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="adm_no">رقم القيد</label>
                        <input type="text" id="adm_no" name="adm_no" class="modern-input w-100" 
                               value="{{ old('adm_no', $student->adm_no) }}">
                        @error('adm_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label for="year_admitted">سنة القبول</label>
                        <input type="text" id="year_admitted" name="year_admitted" class="modern-input w-100" 
                               value="{{ old('year_admitted', $student->year_admitted) }}">
                        @error('year_admitted')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-section text-center">
            <button type="submit" class="btn btn-primary-modern modern-btn mr-3">
                <i class="icon-check mr-2"></i>
                حفظ التغييرات
            </button>
            <a href="{{ route('modern_students.index') }}" class="btn btn-secondary-modern modern-btn">
                <i class="icon-cross mr-2"></i>
                إلغاء
            </a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Handle class selection change
    $('#my_class_id').change(function() {
        var classId = $(this).val();
        if (classId) {
            $.get('{{ route("modern_students.sections", ":id") }}'.replace(':id', classId), function(data) {
                $('#section_id').empty().append('<option value="">اختر الشعبة</option>');
                $.each(data, function(key, section) {
                    $('#section_id').append('<option value="' + section.id + '">' + section.name + '</option>');
                });
            });
        } else {
            $('#section_id').empty().append('<option value="">اختر الشعبة</option>');
        }
    });
});
</script>
@endsection
