@extends('layouts.master')
@section('page_title', 'إدارة سجل الجدول الزمني')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">{{ $ttr->name.' ('.$my_class->name.')'.' '.$ttr->year }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#manage-ts" class="nav-link active" data-toggle="tab">إدارة الفترات الزمنية</a></li>
                <li class="nav-item"><a href="#add-sub" class="nav-link" data-toggle="tab">إضافة مادة</a></li>
                <li class="nav-item"><a href="#edit-subs" class="nav-link " data-toggle="tab">تعديل المواد</a></li>
                <li class="nav-item"><a target="_blank" href="{{ route('ttr.show', $ttr->id) }}" class="nav-link" >عرض الجدول الزمني</a></li>
            </ul>

            <div class="tab-content">
                {{--إضافة الفترات الزمنية--}}
                @include('pages.support_team.timetables.time_slots.index')
                {{--إضافة مادة--}}
                @include('pages.support_team.timetables.subjects.add')
                {{--تعديل المواد--}}
                @include('pages.support_team.timetables.subjects.edit')
            </div>
        </div>
    </div>

    {{--انتهت إدارة الجدول الزمني--}}

@endsection
