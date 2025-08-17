@extends('layouts.master')
@section('page_title', 'تعديل سجل الجدول الزمني')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">تعديل سجل الجدول الزمني</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="col-md-8">
                <form class="ajax-update" method="post" action="{{ route('ttr.update', $ttr->id) }}">
                    @csrf @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">الاسم <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="name" value="{{ $ttr->name }}" required type="text" class="form-control" placeholder="اسم الجدول الزمني">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">الصف <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select required data-placeholder="اختر الصف" class="form-control select" name="my_class_id" id="my_class_id">
                                @foreach($my_classes as $mc)
                                    <option {{ $ttr->my_class_id == $mc->id ? 'selected' : '' }} value="{{ $mc->id }}">{{ $mc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exam_id" class="col-lg-3 col-form-label font-weight-semibold">النوع (صف أو امتحان)</label>
                        <div class="col-lg-9">
                            <select class="select form-control" name="exam_id" id="exam_id">
                                <option value="">جدول زمني للصف</option>
                                @foreach($exams as $ex)
                                    <option {{ $ttr->exam_id == $ex->id ? 'selected' : '' }} value="{{ $ex->id }}">{{ $ex->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="text-right">
                        <button id="ajax-btn" type="submit" class="btn btn-primary">إرسال النموذج <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    {{--انتهى تعديل الجدول الزمني--}}

@endsection
