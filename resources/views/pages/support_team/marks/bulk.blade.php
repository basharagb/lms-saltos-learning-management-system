@extends('layouts.master')
@section('page_title', 'اختر كشف درجات الطالب')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-books mr-2"></i> اختر كشف درجات الطالب</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
                <form method="post" action="{{ route('marks.bulk_select') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <fieldset>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="my_class_id" class="col-form-label font-weight-bold">البرنامج الأكاديمي:</label>
                                            <select required onchange="getClassSections(this.value)" id="my_class_id" name="my_class_id" class="form-control select">
                                                <option value="">اختر البرنامج الأكاديمي</option>
                                                @foreach($my_classes as $c)
                                                    <option {{ ($selected && $my_class_id == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="section_id" class="col-form-label font-weight-bold">القسم:</label>
                                            <select required id="section_id" name="section_id" data-placeholder="اختر البرنامج الأكاديمي أولاً" class="form-control select">
                                                @if($selected && $section_id)
                                                    @foreach($sections->where('my_class_id', $my_class_id) as $s)
                                                        <option {{ $section_id == $s->id ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </fieldset>
                        </div>

                        <div class="col-md-2 mt-4">
                            <div class="text-right mt-1">
                                <button type="submit" class="btn btn-primary">اختر <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </div>

                    </div>
                </form>
        </div>
    </div>

    @if($selected)
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title font-weight-bold">إدارة درجات الطلاب في {{ $my_classes->where('id', $my_class_id)->first()->name.' '.$sections->where('id', $section_id)->first()->name }}</h6>
                {!! Qs::getPanelOptions() !!}
            </div>

            <div class="card-body">
                @include('pages.support_team.marks.bulk_edit')
            </div>
        </div>
    @endif

@endsection
