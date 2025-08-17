@extends('layouts.master')
@section('page_title', 'عرض المادة - '.$s->name. ' ('.$s->my_class->name.')')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">عرض المادة - {{$s->my_class->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>الاسم</th>
                            <td>{{ $s->name }}</td>
                        </tr>
                        <tr>
                            <th>الاسم المختصر</th>
                            <td>{{ $s->slug }}</td>
                        </tr>
                        <tr>
                            <th>الصف</th>
                            <td>{{ $s->my_class->name }}</td>
                        </tr>
                        <tr>
                            <th>المعلم</th>
                            <td>{{ $s->teacher->name ?? 'غير محدد' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="text-right">
                <a href="{{ route('subjects.edit', $s->id) }}" class="btn btn-primary">تعديل <i class="icon-pencil ml-2"></i></a>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">العودة <i class="icon-arrow-left ml-2"></i></a>
            </div>
        </div>
    </div>

@endsection
