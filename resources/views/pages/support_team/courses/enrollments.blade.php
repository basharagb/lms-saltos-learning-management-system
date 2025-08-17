@extends('layouts.master')
@section('page_title', 'تسجيلات المقرر - ' . $course->name)
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Course Info Header -->
        <div class="card bg-primary text-white mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-1">{{ $course->name }} ({{ $course->code }})</h5>
                        <p class="mb-0">{{ $course->myClass->name ?? 'غير محدد' }} - {{ $course->teacher->name ?? 'غير محدد' }}</p>
                    </div>
                    <div class="col-md-4 text-right">
                        <h3 class="mb-0">{{ $enrollments->count() }}</h3>
                        <small>إجمالي التسجيلات</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments Management -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">إدارة تسجيلات المقرر</h6>
                <div class="header-elements">
                    @if(Qs::userIsTeamSA())
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#enrollStudentsModal">
                        <i class="icon-plus2 mr-2"></i>تسجيل طلاب جدد
                    </button>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="text-center p-3 bg-success text-white rounded">
                            <h4 class="mb-1">{{ $enrollments->where('status', 'enrolled')->count() }}</h4>
                            <small>مسجل حالياً</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3 bg-info text-white rounded">
                            <h4 class="mb-1">{{ $enrollments->where('status', 'completed')->count() }}</h4>
                            <small>مكتمل</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3 bg-warning text-white rounded">
                            <h4 class="mb-1">{{ $enrollments->where('status', 'dropped')->count() }}</h4>
                            <small>منسحب</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3 bg-secondary text-white rounded">
                            <h4 class="mb-1">{{ $enrollments->whereNotNull('grade')->count() }}</h4>
                            <small>لديه درجة</small>
                        </div>
                    </div>
                </div>

                <!-- Enrollments Table -->
                <div class="table-responsive">
                    <table class="table table-striped" id="enrollmentsTable">
                        <thead>
                            <tr>
                                <th>الطالب</th>
                                <th>رقم القيد</th>
                                <th>تاريخ التسجيل</th>
                                <th>الحالة</th>
                                <th>الدرجة</th>
                                <th>الدرجة الحرفية</th>
                                <th>تاريخ الإكمال</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-3" style="width: 40px; height: 40px;" 
                                             src="{{ $enrollment->student->user->photo ?? '/assets/images/default-avatar.png' }}" 
                                             alt="صورة الطالب">
                                        <div>
                                            <h6 class="mb-0">{{ $enrollment->student->user->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $enrollment->student->user->email ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $enrollment->student->adm_no ?? 'N/A' }}</td>
                                <td>{{ $enrollment->enrollment_date ? $enrollment->enrollment_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ $enrollment->status == 'enrolled' ? 'success' : ($enrollment->status == 'completed' ? 'info' : 'warning') }}">
                                        @if($enrollment->status == 'enrolled') مسجل
                                        @elseif($enrollment->status == 'completed') مكتمل
                                        @else منسحب
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $enrollment->grade ?? '-' }}</td>
                                <td>{{ $enrollment->grade_letter ?? '-' }}</td>
                                <td>{{ $enrollment->completion_date ? $enrollment->completion_date->format('Y-m-d') : '-' }}</td>
                                <td>
                                    @if(Qs::userIsTeamSA())
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="editEnrollment({{ $enrollment->id }}, '{{ $enrollment->status }}', '{{ $enrollment->grade }}', '{{ $enrollment->grade_letter }}')">
                                        <i class="icon-pencil"></i> تعديل
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enroll Students Modal -->
@if(Qs::userIsTeamSA())
<div class="modal fade" id="enrollStudentsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تسجيل طلاب جدد في المقرر</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="{{ route('courses.enroll', $course->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>اختر الطلاب للتسجيل:</label>
                        <select name="student_ids[]" class="form-control select2" multiple required>
                            <!-- Will be populated via AJAX based on course class -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تسجيل الطلاب</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Enrollment Modal -->
<div class="modal fade" id="editEnrollmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل حالة التسجيل</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="editEnrollmentForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_status">الحالة:</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="enrolled">مسجل</option>
                            <option value="completed">مكتمل</option>
                            <option value="dropped">منسحب</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_grade">الدرجة:</label>
                        <input type="number" name="grade" id="edit_grade" class="form-control" 
                               min="0" max="100" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="edit_grade_letter">الدرجة الحرفية:</label>
                        <select name="grade_letter" id="edit_grade_letter" class="form-control">
                            <option value="">اختر الدرجة</option>
                            <option value="A+">A+</option>
                            <option value="A">A</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="B-">B-</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>
                            <option value="C-">C-</option>
                            <option value="D+">D+</option>
                            <option value="D">D</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#enrollmentsTable').DataTable({
        "language": {
            "processing": "جاري المعالجة...",
            "lengthMenu": "أظهر _MENU_ مدخلات",
            "zeroRecords": "لم يعثر على أية سجلات",
            "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "infoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "infoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "search": "ابحث:",
            "paginate": {
                "first": "الأول",
                "previous": "السابق",
                "next": "التالي",
                "last": "الأخير"
            }
        },
        "pageLength": 25,
        "order": [[2, "desc"]]
    });

    // Load available students for enrollment
    $('#enrollStudentsModal').on('show.bs.modal', function() {
        $.get('/ajax/get_class_students/{{ $course->my_class_id }}', function(data) {
            var select = $('select[name="student_ids[]"]');
            select.empty();
            $.each(data, function(key, student) {
                select.append('<option value="' + student.id + '">' + student.user.name + ' (' + student.adm_no + ')</option>');
            });
        });
    });
});

function editEnrollment(enrollmentId, status, grade, gradeLetter) {
    $('#editEnrollmentForm').attr('action', '/courses/enrollments/' + enrollmentId);
    $('#edit_status').val(status);
    $('#edit_grade').val(grade);
    $('#edit_grade_letter').val(gradeLetter);
    $('#editEnrollmentModal').modal('show');
}
</script>
@endsection
