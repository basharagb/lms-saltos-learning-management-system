@extends('layouts.master')
@section('page_title', 'إدارة الترقيات')
@section('content')

    {{--إعادة تعيين الكل--}}
    <div class="card">
        <div class="card-body text-center
">
            <button id="promotion-reset-all" class="btn btn-danger btn-large">إعادة تعيين جميع الترقيات للفصل الدراسي</button>
        </div>
    </div>

{{-- إعادة تعيين الترقيات --}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">إدارة الترقيات - الطلاب الذين تمت ترقيتهم من <span class="text-danger">{{ $old_year }}</span> إلى <span class="text-success">{{ $new_year }}</span> الفصل الدراسي</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">

            <table id="promotions-list" class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>م</th>
                    <th>الصورة</th>
                    <th>الاسم</th>
                    <th>من الصف</th>
                    <th>إلى الصف</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promotions->sortBy('fc.name')->sortBy('student.name') as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $p->student->photo }}" alt="photo"></td>
                        <td>{{ $p->student->name }}</td>
                        <td>{{ $p->fc->name.' '.$p->fs->name }}</td>
                        <td>{{ $p->tc->name.' '.$p->ts->name }}</td>
                        @if($p->status === 'P')
                            <td><span class="text-success">تمت الترقية</span></td>
                        @elseif($p->status === 'D')
                            <td><span class="text-danger">لم تتم الترقية</span></td>
                        @else
                            <td><span class="text-primary">متخرج</span></td>
                        @endif
                        <td class="text-center">
                            <button data-id="{{ $p->id }}" class="btn btn-danger promotion-reset">إعادة تعيين</button>
                            <form id="promotion-reset-{{ $p->id }}" method="post" action="{{ route('students.promotion_reset', $p->id) }}">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        /* إعادة تعيين فردي */
        $('.promotion-reset').on('click', function () {
            let pid = $(this).data('id');
            if (confirm('هل أنت متأكد من أنك تريد المتابعة؟')){
                $('form#promotion-reset-'+pid).submit();
            }
            return false;
        });

        /* إعادة تعيين جميع الترقيات */
        $('#promotion-reset-all').on('click', function () {
            if (confirm('هل أنت متأكد من أنك تريد المتابعة؟')){
                $.ajax({
                    url:"{{ route('students.promotion_reset_all') }}",
                    type:'DELETE',
                    data:{ '_token' : $('#csrf-token').attr('content') },
                    success:function (resp) {
                        $('table#promotions-list > tbody').fadeOut().remove();
                        flash({msg : resp.msg, type : 'success'});
                    }
                })
            }
            return false;
        })
    </script>
@endsection
