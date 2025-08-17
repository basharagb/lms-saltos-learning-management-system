@extends('layouts.master')
@section('page_title', 'إعدادات النظام')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title font-weight-semibold">تحديث إعدادات النظام</h6>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">اسم المدرسة <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input name="system_name" value="{{ $s['system_name'] }}" required type="text" class="form-control" placeholder="اسم المدرسة">
                </div>
            </div>

            <div class="form-group row">
                <label for="current_session" class="col-lg-3 col-form-label font-weight-semibold">الفصل الدراسي الحالي <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="current_session" id="current_session" required class="form-control">
                        @foreach($sessions as $session)
                            <option {{ $s['current_session'] == $session ? 'selected' : '' }} value="{{ $session }}">{{ $session }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">اختصار المدرسة</label>
                <div class="col-lg-9">
                    <input name="system_title" value="{{ $s['system_title'] }}" type="text" class="form-control" placeholder="اختصار المدرسة">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">رقم الهاتف</label>
                <div class="col-lg-9">
                    <input name="phone" value="{{ $s['phone'] }}" type="text" class="form-control" placeholder="رقم الهاتف">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">البريد الإلكتروني للمدرسة</label>
                <div class="col-lg-9">
                    <input name="email" value="{{ $s['email'] }}" type="email" class="form-control" placeholder="البريد الإلكتروني">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">عنوان المدرسة <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input name="address" value="{{ $s['address'] }}" required type="text" class="form-control" placeholder="عنوان المدرسة">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">ينتهي هذا الفصل</label>
                <div class="col-lg-9">
                    <input name="this_term_ends" value="{{ $s['this_term_ends'] }}" type="date" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">يبدأ الفصل القادم</label>
                <div class="col-lg-9">
                    <input name="next_term_begins" value="{{ $s['next_term_begins'] }}" type="date" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="lock_exam" class="col-lg-3 col-form-label font-weight-semibold">قفل الامتحانات</label>
                <div class="col-lg-9">
                    <select name="lock_exam" id="lock_exam" class="form-control">
                        <option {{ $s['lock_exam'] ? 'selected' : '' }} value="1">نعم</option>
                        <option {{ $s['lock_exam'] ?: 'selected' }} value="0">لا</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">رسوم الفصل القادم</label>
                <div class="col-lg-9">
                    @foreach($class_types as $ct)
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">{{ $ct->name }}</label>
                            <div class="col-lg-9">
                                <input class="form-control" value="{{ $s['next_term_fees_'.strtolower($ct->code)] }}" name="next_term_fees_{{ strtolower($ct->code) }}" placeholder="{{ $ct->name }}" type="text">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">تغيير الشعار:</label>
                <div class="col-lg-9">
                    <input name="logo" type="file" class="form-control">
                    @if($s['logo'])
                        <small class="form-text text-muted">الشعار الحالي: {{ $s['logo'] }}</small>
                    @endif
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-danger">إرسال النموذج <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>

@endsection
