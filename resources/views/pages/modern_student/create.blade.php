@extends('layouts.master')
@section('page_title', 'إضافة طالب جديد')
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

.form-step {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 20px 30px;
}

.step-indicator {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.step-item {
    display: flex;
    align-items: center;
    margin: 0 15px;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-left: 10px;
    transition: all 0.3s ease;
}

.step-number.active {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
}

.step-number.completed {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.step-title {
    font-weight: 600;
    color: #475569;
}

.step-title.active {
    color: #1e40af;
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

.form-label-modern {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    display: block;
}

.required-asterisk {
    color: #ef4444;
    margin-right: 5px;
}

.form-section {
    padding: 30px;
    border-bottom: 1px solid #f1f5f9;
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    color: #1e3a8a;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e3f2fd;
}

.modern-btn {
    border-radius: 12px;
    padding: 15px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    font-size: 1rem;
}

.btn-primary-modern {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
}

.btn-primary-modern:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

.btn-secondary-modern {
    background: #6b7280;
    color: white;
}

.btn-secondary-modern:hover {
    background: #4b5563;
    transform: translateY(-2px);
}

.photo-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    background: #f9fafb;
    transition: all 0.3s ease;
    cursor: pointer;
}

.photo-upload-area:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.photo-upload-area.dragover {
    border-color: #1e40af;
    background: #dbeafe;
}

.upload-icon {
    font-size: 3rem;
    color: #9ca3af;
    margin-bottom: 15px;
}

.autocomplete-container {
    position: relative;
}

.autocomplete-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.autocomplete-item {
    padding: 12px 16px;
    cursor: pointer;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s ease;
}

.autocomplete-item:hover {
    background: #f8fafc;
}

.autocomplete-item:last-child {
    border-bottom: none;
}
</style>

<div class="content">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('modern_students.index') }}" class="btn btn-secondary-modern modern-btn">
            <i class="icon-arrow-right8 mr-2"></i> العودة إلى قائمة الطلاب
        </a>
    </div>

    <!-- Form Card -->
    <div class="modern-form-card">
        <!-- Header -->
        <div class="form-header">
            <h2><i class="icon-user-plus mr-3"></i> إضافة طالب جديد</h2>
            <p class="mb-0 opacity-90">يرجى ملء جميع البيانات المطلوبة بدقة</p>
        </div>

        <!-- Step Indicator -->
        <div class="form-step">
            <div class="step-indicator">
                <div class="step-item">
                    <div class="step-number active" id="step-1-indicator">1</div>
                    <span class="step-title active">البيانات الشخصية</span>
                </div>
                <div class="step-item">
                    <div class="step-number" id="step-2-indicator">2</div>
                    <span class="step-title">البيانات الأكاديمية</span>
                </div>
                <div class="step-item">
                    <div class="step-number" id="step-3-indicator">3</div>
                    <span class="step-title">المراجعة والحفظ</span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form id="modern-student-form" method="post" enctype="multipart/form-data" action="{{ route('students.store') }}">
            @csrf
            
            <!-- Step 1: Personal Information -->
            <div class="form-section" id="step-1">
                <h4 class="section-title"><i class="icon-user mr-2"></i> البيانات الشخصية</h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label-modern">
                                <span class="required-asterisk">*</span>الاسم الكامل
                            </label>
                            <input type="text" name="name" class="form-control modern-input" 
                                   placeholder="أدخل الاسم الكامل للطالب" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label-modern">
                                <span class="required-asterisk">*</span>العنوان
                            </label>
                            <input type="text" name="address" class="form-control modern-input" 
                                   placeholder="أدخل عنوان السكن" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control modern-input" 
                                   placeholder="example@email.com">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control modern-input" 
                                   placeholder="+966 5X XXX XXXX">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">الهاتف الثابت</label>
                            <input type="text" name="phone2" class="form-control modern-input" 
                                   placeholder="+966 1X XXX XXXX">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label-modern">
                                <span class="required-asterisk">*</span>الجنس
                            </label>
                            <select name="gender" class="form-control modern-select" required>
                                <option value="">اختر الجنس</option>
                                <option value="Male">ذكر</option>
                                <option value="Female">أنثى</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label-modern">تاريخ الميلاد</label>
                            <input type="date" name="dob" class="form-control modern-input">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label-modern">الجنسية</label>
                            <select name="nal_id" class="form-control modern-select select-search" data-placeholder="اختر الجنسية">
                                <option value="">اختر الجنسية</option>
                                @foreach($nationals as $national)
                                    <option value="{{ $national->id }}">{{ $national->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label-modern">فصيلة الدم</label>
                            <select name="bg_id" class="form-control modern-select" data-placeholder="اختر فصيلة الدم">
                                <option value="">اختر فصيلة الدم</option>
                                @foreach($blood_groups as $bg)
                                    <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">المحافظة</label>
                            <select name="state_id" id="state_id" class="form-control modern-select select-search" data-placeholder="اختر المحافظة">
                                <option value="">اختر المحافظة</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">المنطقة</label>
                            <select name="lga_id" id="lga_id" class="form-control modern-select" data-placeholder="اختر المحافظة أولاً">
                                <option value="">اختر المحافظة أولاً</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">ولي الأمر</label>
                            <div class="autocomplete-container">
                                <input type="text" id="parent-search" class="form-control modern-input" 
                                       placeholder="ابحث عن ولي الأمر...">
                                <input type="hidden" name="parent_id" id="parent_id">
                                <div class="autocomplete-results" id="parent-results"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload -->
                <div class="form-group">
                    <label class="form-label-modern">الصورة الشخصية</label>
                    <div class="photo-upload-area" onclick="document.getElementById('photo-input').click()">
                        <div class="upload-icon">
                            <i class="icon-camera"></i>
                        </div>
                        <h5>اضغط لرفع الصورة الشخصية</h5>
                        <p class="text-muted">أو اسحب الصورة هنا</p>
                        <small class="text-muted">الصور المقبولة: JPG, PNG. الحد الأقصى: 2MB</small>
                    </div>
                    <input type="file" id="photo-input" name="photo" accept="image/*" style="display: none;">
                </div>

                <div class="text-left mt-4">
                    <button type="button" class="btn btn-primary-modern modern-btn" onclick="nextStep(2)">
                        التالي <i class="icon-arrow-left8 mr-2"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Academic Information -->
            <div class="form-section" id="step-2" style="display: none;">
                <h4 class="section-title"><i class="icon-graduation2 mr-2"></i> البيانات الأكاديمية</h4>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">
                                <span class="required-asterisk">*</span>البرنامج الأكاديمي
                            </label>
                            <select name="my_class_id" id="my_class_id" class="form-control modern-select" required>
                                <option value="">اختر البرنامج الأكاديمي</option>
                                @foreach($my_classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">
                                <span class="required-asterisk">*</span>القسم
                            </label>
                            <select name="section_id" id="section_id" class="form-control modern-select" required>
                                <option value="">اختر البرنامج أولاً</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label-modern">رقم القبول</label>
                            <input type="text" name="adm_no" class="form-control modern-input" 
                                   placeholder="سيتم إنشاؤه تلقائياً إذا ترك فارغاً">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label-modern">سنة القبول</label>
                            <input type="number" name="year_admitted" class="form-control modern-input" 
                                   value="{{ date('Y') }}" min="2000" max="{{ date('Y') + 1 }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label-modern">السكن الجامعي</label>
                            <select name="dorm_id" class="form-control modern-select" data-placeholder="اختر السكن">
                                <option value="">لا يوجد سكن</option>
                                @foreach($dorms as $dorm)
                                    <option value="{{ $dorm->id }}">{{ $dorm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary-modern modern-btn" onclick="prevStep(1)">
                        <i class="icon-arrow-right8 mr-2"></i> السابق
                    </button>
                    <button type="button" class="btn btn-primary-modern modern-btn" onclick="nextStep(3)">
                        التالي <i class="icon-arrow-left8 mr-2"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Review and Submit -->
            <div class="form-section" id="step-3" style="display: none;">
                <h4 class="section-title"><i class="icon-checkmark mr-2"></i> مراجعة البيانات والحفظ</h4>
                
                <div class="alert alert-info">
                    <i class="icon-info22 mr-2"></i>
                    يرجى مراجعة جميع البيانات المدخلة قبل الحفظ. يمكنك العودة لتعديل أي بيانات إذا لزم الأمر.
                </div>

                <div id="review-content">
                    <!-- Review content will be populated by JavaScript -->
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary-modern modern-btn" onclick="prevStep(2)">
                        <i class="icon-arrow-right8 mr-2"></i> السابق
                    </button>
                    <button type="submit" class="btn btn-primary-modern modern-btn" id="submit-btn">
                        <i class="icon-checkmark mr-2"></i> حفظ بيانات الطالب
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
let currentStep = 1;

// Step navigation
function nextStep(step) {
    if (validateCurrentStep()) {
        $(`#step-${currentStep}`).hide();
        $(`#step-${step}`).show();

        // Update indicators
        $(`#step-${currentStep}-indicator`).removeClass('active').addClass('completed');
        $(`#step-${step}-indicator`).addClass('active');

        currentStep = step;

        if (step === 3) {
            populateReview();
        }
    }
}

function prevStep(step) {
    $(`#step-${currentStep}`).hide();
    $(`#step-${step}`).show();

    // Update indicators
    $(`#step-${currentStep}-indicator`).removeClass('active');
    $(`#step-${step}-indicator`).removeClass('completed').addClass('active');

    currentStep = step;
}

// Form validation
function validateCurrentStep() {
    let isValid = true;
    const currentSection = $(`#step-${currentStep}`);

    currentSection.find('input[required], select[required]').each(function() {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            isValid = false;
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    if (!isValid) {
        swal("خطأ في البيانات", "يرجى ملء جميع الحقول المطلوبة", "error");
    }

    return isValid;
}

// Load sections based on class selection
$('#my_class_id').on('change', function() {
    const classId = $(this).val();
    if (classId) {
        $.get(`{{ route('get-class-sections', '') }}/${classId}`, function(sections) {
            let options = '<option value="">اختر القسم</option>';
            sections.forEach(function(section) {
                options += `<option value="${section.id}">${section.name}</option>`;
            });
            $('#section_id').html(options);
        });
    } else {
        $('#section_id').html('<option value="">اختر البرنامج أولاً</option>');
    }
});

// Load LGAs based on state selection
$('#state_id').on('change', function() {
    const stateId = $(this).val();
    if (stateId) {
        $.get(`{{ route('get-lgas', '') }}/${stateId}`, function(lgas) {
            let options = '<option value="">اختر المنطقة</option>';
            lgas.forEach(function(lga) {
                options += `<option value="${lga.id}">${lga.name}</option>`;
            });
            $('#lga_id').html(options);
        });
    } else {
        $('#lga_id').html('<option value="">اختر المحافظة أولاً</option>');
    }
});

// Parent search autocomplete
let parentSearchTimeout;
$('#parent-search').on('input', function() {
    const term = $(this).val();
    clearTimeout(parentSearchTimeout);

    if (term.length >= 2) {
        parentSearchTimeout = setTimeout(function() {
            $.get('{{ route("search-parents") }}', { term: term }, function(parents) {
                let results = '';
                parents.forEach(function(parent) {
                    results += `
                        <div class="autocomplete-item" onclick="selectParent(${parent.id}, '${parent.name}')">
                            <strong>${parent.name}</strong><br>
                            <small class="text-muted">${parent.email || 'لا يوجد بريد إلكتروني'}</small>
                        </div>
                    `;
                });
                $('#parent-results').html(results).show();
            });
        }, 300);
    } else {
        $('#parent-results').hide();
    }
});

function selectParent(id, name) {
    $('#parent-search').val(name);
    $('#parent_id').val(id);
    $('#parent-results').hide();
}

// Hide autocomplete when clicking outside
$(document).on('click', function(e) {
    if (!$(e.target).closest('.autocomplete-container').length) {
        $('.autocomplete-results').hide();
    }
});

// Photo upload handling
$('#photo-input').on('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('.photo-upload-area').html(`
                <img src="${e.target.result}" style="max-width: 200px; max-height: 200px; border-radius: 10px;">
                <p class="mt-2 text-success">تم اختيار الصورة بنجاح</p>
                <button type="button" class="btn btn-sm btn-secondary" onclick="clearPhoto()">تغيير الصورة</button>
            `);
        };
        reader.readAsDataURL(file);
    }
});

function clearPhoto() {
    $('#photo-input').val('');
    $('.photo-upload-area').html(`
        <div class="upload-icon">
            <i class="icon-camera"></i>
        </div>
        <h5>اضغط لرفع الصورة الشخصية</h5>
        <p class="text-muted">أو اسحب الصورة هنا</p>
        <small class="text-muted">الصور المقبولة: JPG, PNG. الحد الأقصى: 2MB</small>
    `);
}

// Drag and drop for photo upload
$('.photo-upload-area').on('dragover', function(e) {
    e.preventDefault();
    $(this).addClass('dragover');
});

$('.photo-upload-area').on('dragleave', function(e) {
    e.preventDefault();
    $(this).removeClass('dragover');
});

$('.photo-upload-area').on('drop', function(e) {
    e.preventDefault();
    $(this).removeClass('dragover');

    const files = e.originalEvent.dataTransfer.files;
    if (files.length > 0) {
        $('#photo-input')[0].files = files;
        $('#photo-input').trigger('change');
    }
});

// Populate review section
function populateReview() {
    const formData = new FormData($('#modern-student-form')[0]);
    let reviewHtml = '<div class="row">';

    // Personal Information
    reviewHtml += `
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6><i class="icon-user mr-2"></i> البيانات الشخصية</h6>
                </div>
                <div class="card-body">
                    <p><strong>الاسم:</strong> ${$('input[name="name"]').val() || 'غير محدد'}</p>
                    <p><strong>العنوان:</strong> ${$('input[name="address"]').val() || 'غير محدد'}</p>
                    <p><strong>البريد الإلكتروني:</strong> ${$('input[name="email"]').val() || 'غير محدد'}</p>
                    <p><strong>الهاتف:</strong> ${$('input[name="phone"]').val() || 'غير محدد'}</p>
                    <p><strong>الجنس:</strong> ${$('select[name="gender"] option:selected').text() || 'غير محدد'}</p>
                </div>
            </div>
        </div>
    `;

    // Academic Information
    reviewHtml += `
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6><i class="icon-graduation2 mr-2"></i> البيانات الأكاديمية</h6>
                </div>
                <div class="card-body">
                    <p><strong>البرنامج:</strong> ${$('select[name="my_class_id"] option:selected').text() || 'غير محدد'}</p>
                    <p><strong>القسم:</strong> ${$('select[name="section_id"] option:selected').text() || 'غير محدد'}</p>
                    <p><strong>رقم القبول:</strong> ${$('input[name="adm_no"]').val() || 'سيتم إنشاؤه تلقائياً'}</p>
                    <p><strong>سنة القبول:</strong> ${$('input[name="year_admitted"]').val() || 'غير محدد'}</p>
                    <p><strong>ولي الأمر:</strong> ${$('#parent-search').val() || 'غير محدد'}</p>
                </div>
            </div>
        </div>
    `;

    reviewHtml += '</div>';
    $('#review-content').html(reviewHtml);
}

// Form submission
$('#modern-student-form').on('submit', function(e) {
    e.preventDefault();

    const submitBtn = $('#submit-btn');
    const originalText = submitBtn.html();

    submitBtn.prop('disabled', true).html('<i class="icon-spinner2 spinner mr-2"></i> جاري الحفظ...');

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(response) {
            swal("تم بنجاح!", "تم إضافة الطالب بنجاح", "success").then(function() {
                window.location.href = "{{ route('modern_students.index') }}";
            });
        },
        error: function(xhr) {
            let errorMessage = 'حدث خطأ أثناء حفظ البيانات';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                const errors = Object.values(xhr.responseJSON.errors).flat();
                errorMessage = errors.join('<br>');
            }
            swal("خطأ!", errorMessage, "error");
            submitBtn.prop('disabled', false).html(originalText);
        }
    });
});

// Remove validation styling on input
$('input, select').on('input change', function() {
    $(this).removeClass('is-invalid');
});
</script>
@endsection
