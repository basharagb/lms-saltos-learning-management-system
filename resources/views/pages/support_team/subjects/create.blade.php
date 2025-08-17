@extends('layouts.master')
@section('page_title', 'إضافة مادة جديدة')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">إضافة مادة جديدة</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form class="ajax-store" method="post" action="{{ route('subjects.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-lg-3 col-form-label font-weight-semibold">الاسم <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="name" name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="اسم المادة">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-lg-3 col-form-label font-weight-semibold">الاسم المختصر <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="slug" required name="slug" value="{{ old('slug') }}" type="text" class="form-control" placeholder="مثال: B.Eng">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">اختر الصف <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select required data-placeholder="اختر الصف" class="form-control select" name="my_class_id" id="my_class_id">
                            <option value=""></option>
                            @foreach($my_classes as $c)
                                <option {{ old('my_class_id') == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">المعلم <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select required data-placeholder="اختر المعلم" class="form-control select-search" name="teacher_id" id="teacher_id">
                            <option value=""></option>
                            @foreach($teachers as $t)
                                <option {{ old('teacher_id') == Qs::hash($t->id) ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">إرسال النموذج <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>

@endsection
