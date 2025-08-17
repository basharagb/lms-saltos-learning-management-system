<table class="table table-bordered table-responsive text-center">
    <thead>
    <tr>
        <th rowspan="2">م</th>
        <th rowspan="2">المواد الدراسية</th>
        <th rowspan="2">الواجب الأول<br>(20)</th>
        <th rowspan="2">الواجب الثاني<br>(20)</th>
        <th rowspan="2">الامتحان<br>(60)</th>
        <th rowspan="2">المجموع<br>(100)</th>

        {{--@if($ex->term == 3) --}}{{-- 3rd Term --}}{{--
        <th rowspan="2">المجموع <br>(100%) الفصل الثالث</th>
        <th rowspan="2">الفصل الأول</th>
        <th rowspan="2">الفصل الثاني</th>
        <th rowspan="2">المجموع التراكمي (300%) الفصل الأول + الثاني + الثالث</th>
        <th rowspan="2">المعدل التراكمي</th>
        @endif--}}

        <th rowspan="2">الدرجة</th>
        <th rowspan="2">ترتيب المادة</th>
        <th rowspan="2">ملاحظات</th>
    </tr>
    </thead>

    <tbody>
    @foreach($subjects as $sub)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-left">{{ $sub->name }}</td>
            <td>{{ $marks->where('subject_id', $sub->id)->first()->ca1 ?? '-' }}</td>
            <td>{{ $marks->where('subject_id', $sub->id)->first()->ca2 ?? '-' }}</td>
            <td>{{ $marks->where('subject_id', $sub->id)->first()->exam ?? '-' }}</td>
            <td>{{ $marks->where('subject_id', $sub->id)->first()->total ?? '-' }}</td>

            {{--@if($ex->term == 3)
                <td>{{ $marks->where('subject_id', $sub->id)->first()->tex3 ?? '-' }}</td>
                <td>{{ $marks->where('subject_id', $sub->id)->first()->tex1 ?? '-' }}</td>
                <td>{{ $marks->where('subject_id', $sub->id)->first()->tex2 ?? '-' }}</td>
                <td>{{ $marks->where('subject_id', $sub->id)->first()->cum ?? '-' }}</td>
                <td>{{ $marks->where('subject_id', $sub->id)->first()->cum_ave ?? '-' }}</td>
            @endif--}}

            <td>{{ $marks->where('subject_id', $sub->id)->first()->grade ?? '-' }}</td>
            <td>{{ $marks->where('subject_id', $sub->id)->first()->pos ?? '-' }}</td>
            <td>{{ $marks->where('subject_id', $sub->id)->first()->remarks ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
