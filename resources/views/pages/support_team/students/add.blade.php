@extends('layouts.master')
@section('page_title', 'قبول طالب جديد')
@section('content')
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">يرجى ملء النموذج أدناه لقبول طالب جديد</h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('students.store') }}" data-fouc>
               @csrf
                <h6>البيانات الشخصية</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الاسم الكامل: <span class="text-danger">*</span></label>
                                <input value="{{ old('name') }}" required type="text" name="name" placeholder="الاسم الكامل" class="form-control">
                                </div>
                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>العنوان: <span class="text-danger">*</span></label>
                                <input value="{{ old('address') }}" class="form-control" placeholder="العنوان" name="address" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>البريد الإلكتروني: </label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="البريد الإلكتروني">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">الجنس: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="اختر...">
                                    <option value=""></option>
                                    <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">ذكر</option>
                                    <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">أنثى</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>الهاتف:</label>
                                <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="رقم الهاتف" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>الهاتف الثابت:</label>
                                <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="رقم الهاتف الثابت" >
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>تاريخ الميلاد:</label>
                                <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="اختر التاريخ...">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">الجنسية: <span class="text-danger">*</span></label>
                                <select data-placeholder="اختر..." required name="nal_id" id="nal_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($nationals as $nal)
                                        <option {{ (old('nal_id') == $nal->id ? 'selected' : '') }} value="{{ $nal->id }}">{{ $nal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="state_id">المحافظة: <span class="text-danger">*</span></label>
                            <select onchange="getLGA(this.value)" required data-placeholder="اختر..." class="select-search form-control" name="state_id" id="state_id">
                                <option value=""></option>
                                @foreach($states as $st)
                                    <option {{ (old('state_id') == $st->id ? 'selected' : '') }} value="{{ $st->id }}">{{ $st->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="lga_id">المنطقة: <span class="text-danger">*</span></label>
                            <select required data-placeholder="اختر المحافظة أولاً" class="select-search form-control" name="lga_id" id="lga_id">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bg_id">فصيلة الدم: </label>
                                <select class="select form-control" id="bg_id" name="bg_id" data-fouc data-placeholder="اختر...">
                                    <option value=""></option>
                                    @foreach(App\Models\BloodGroup::all() as $bg)
                                        <option {{ (old('bg_id') == $bg->id ? 'selected' : '') }} value="{{ $bg->id }}">{{ $bg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">رفع الصورة الشخصية:</label>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">الصور المقبولة: jpeg, png. الحد الأقصى للملف 2 ميجابايت</span>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <h6>البيانات الأكاديمية</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="my_class_id">البرنامج الأكاديمي: <span class="text-danger">*</span></label>
                                <select required data-placeholder="اختر البرنامج الأكاديمي" class="select-search form-control" name="my_class_id" id="my_class_id">
                                    <option value=""></option>
                                    @foreach($my_classes as $mc)
                                        <option {{ (old('my_class_id') == $mc->id ? 'selected' : '') }} value="{{ $mc->id }}">{{ $mc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id">القسم: <span class="text-danger">*</span></label>
                                <select required data-placeholder="اختر البرنامج الأكاديمي أولاً" class="select-search form-control" name="section_id" id="section_id">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="my_parent_id">ولي الأمر: </label>
                                <select data-placeholder="اختر ولي الأمر" name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($parents as $p)
                                        <option {{ (old('my_parent_id') == Qs::hash($p->id) ? 'selected' : '') }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="year_admitted">سنة القبول: <span class="text-danger">*</span></label>
                                <select required data-placeholder="اختر سنة القبول" class="select form-control" name="year_admitted" id="year_admitted">
                                    <option value=""></option>
                                    @for($y = date('Y'); $y >= 2010; $y--)
                                        <option {{ (old('year_admitted') == $y ? 'selected' : '') }} value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="dorm_id">السكن الداخلي: </label>
                            <select data-placeholder="اختر..."  name="dorm_id" id="dorm_id" class="select-search form-control">
                                <option value=""></option>
                                @foreach($dorms as $d)
                                    <option {{ (old('dorm_id') == $d->id) ? 'selected' : '' }} value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                            </select>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>رقم غرفة السكن:</label>
                                <input type="text" name="dorm_room_no" placeholder="رقم غرفة السكن" class="form-control" value="{{ old('dorm_room_no') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>بيت الرياضة:</label>
                                <input type="text" name="house" placeholder="بيت الرياضة" class="form-control" value="{{ old('house') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>رقم القبول:</label>
                                <input type="text" name="adm_no" placeholder="رقم القبول" class="form-control" value="{{ old('adm_no') }}">
                            </div>
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>
    @endsection
