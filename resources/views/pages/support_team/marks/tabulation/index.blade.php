@extends('layouts.master')
@section('page_title', __('tabulation.tabulation_sheet'))
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-books mr-2"></i> {{ __('tabulation.tabulation_sheet') }}</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
        <form method="post" action="{{ route('marks.tabulation_select') }}">
                    @csrf
                    <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exam_id" class="col-form-label font-weight-bold">{{ __('tabulation.exam') }}:</label>
                                            <select required id="exam_id" name="exam_id" class="form-control select" data-placeholder="{{ __('tabulation.select_exam_placeholder') }}">
                                                @foreach($exams as $exm)
                                                    <option {{ ($selected && $exam_id == $exm->id) ? 'selected' : '' }} value="{{ $exm->id }}">{{ $exm->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="my_class_id" class="col-form-label font-weight-bold">{{ __('tabulation.class') }}:</label>
                                            <select onchange="getClassSections(this.value)" required id="my_class_id" name="my_class_id" class="form-control select" data-placeholder="{{ __('tabulation.select_class_placeholder') }}">
                                                <option value=""></option>
                                                @foreach($my_classes as $c)
                                                    <option {{ ($selected && $my_class_id == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id" class="col-form-label font-weight-bold">{{ __('tabulation.section') }}:</label>
                                <select required id="section_id" name="section_id" data-placeholder="{{ __('tabulation.select_class_first') }}" class="form-control select">
                                    @if($selected)
                                        @foreach($sections->where('my_class_id', $my_class_id) as $s)
                                            <option {{ $section_id == $s->id ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-md-2 mt-4">
                            <div class="text-right mt-1">
                                <button type="submit" class="btn btn-primary">{{ __('tabulation.view_sheet') }} <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </div>

                    </div>

                </form>
        </div>
    </div>

    {{--if Selction Has Been Made --}}

    @if($selected)
        <div class="card">
            <div class="card-header">
                <h6 class="card-title font-weight-bold">جدول النتائج لـ {{ $my_class->name.' '.$section->name.' - '.$ex->name.' ('.$year.')' }}</h6>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>أسماء الطلاب في الفصل</th>
                       @foreach($subjects as $sub)
                       <th title="{{ $sub->name }}" rowspan="2">{{ strtoupper($sub->slug ?: $sub->name) }}</th>
                       @endforeach
                        {{--@if($ex->term == 3)
                        <th>مجموع الفصل الأول</th>
                        <th>مجموع الفصل الثاني</th>
                        <th>مجموع الفصل الثالث</th>
                        <th style="color: darkred">المجموع التراكمي</th>
                        <th style="color: darkblue">المعدل التراكمي</th>
                        @endif--}}
                        <th style="color: darkred">{{ __('tabulation.total') }}</th>
                        <th style="color: darkblue">{{ __('tabulation.average') }}</th>
                        <th style="color: darkgreen">{{ __('tabulation.position') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align: center">{{ $s->user->name }}</td>
                            @foreach($subjects as $sub)
                            <td>{{ $marks->where('student_id', $s->user_id)->where('subject_id', $sub->id)->first()->$tex ?? '-' ?: '-' }}</td>
                            @endforeach

                            {{--@if($ex->term == 3)
                                --}}{{--1st term Total--}}{{--
                            <td>{{ Mk::getTermTotal($s->user_id, 1, $year) ?? '-' }}</td>
                            --}}{{--2nd Term Total--}}{{--
                            <td>{{ Mk::getTermTotal($s->user_id, 2, $year) ?? '-' }}</td>
                            --}}{{--3rd Term total--}}{{--
                            <td>{{ Mk::getTermTotal($s->user_id, 3, $year) ?? '-' }}</td>
                            @endif--}}

                            <td style="color: darkred">{{ $exr->where('student_id', $s->user_id)->first()->total ?: '-' }}</td>
                            <td style="color: darkblue">{{ $exr->where('student_id', $s->user_id)->first()->ave ?: '-' }}</td>
                            <td style="color: darkgreen">{!! Mk::getSuffix($exr->where('student_id', $s->user_id)->first()->pos) ?: '-' !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--Print Button--}}
                <div class="text-center mt-4">
                    <a target="_blank" href="{{  route('marks.print_tabulation', [$exam_id, $my_class_id, $section_id]) }}" class="btn btn-danger btn-lg"><i class="icon-printer mr-2"></i> Print Tabulation Sheet</a>
                </div>
            </div>
        </div>
    @endif
@endsection
