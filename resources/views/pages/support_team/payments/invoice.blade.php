@extends('layouts.master')
@section('page_title', __('payments.manage_payments'))
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">{{ __('payments.manage_payments') }} {{ __('payments.for') }} {{ $sr->user->name}} </h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#all-uc" class="nav-link active" data-toggle="tab">{{ __('payments.incomplete_payments') }}</a></li>
                    <li class="nav-item"><a href="#all-cl" class="nav-link" data-toggle="tab">{{ __('payments.completed_payments') }}</a></li>
                </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="all-uc">
                <table class="table datatable-button-html5-columns table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('payments.title') }}</th>
                        <th>{{ __('payments.pay_ref') }}</th>
                        <th>{{ __('payments.amount') }}</th>
                        <th>{{ __('payments.paid') }}</th>
                        <th>{{ __('payments.balance') }}</th>
                        <th>{{ __('payments.pay_now') }}</th>
                        <th>{{ __('payments.receipt_no') }}</th>
                        <th>{{ __('payments.year') }}</th>
                        <th>{{ __('payments.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uncleared as $uc)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $uc->payment->title }}</td>
                            <td>{{ $uc->payment->ref_no }}</td>

                            {{--Amount--}}
                            <td class="font-weight-bold" id="amt-{{ Qs::hash($uc->id) }}" data-amount="{{ $uc->payment->amount }}">{{ $uc->payment->amount }}</td>

                            {{--Amount Paid--}}
                            <td id="amt_paid-{{ Qs::hash($uc->id) }}" data-amount="{{ $uc->amt_paid ?: 0 }}" class="text-blue font-weight-bold">{{ $uc->amt_paid ?: '0.00' }}</td>

                            {{--Balance--}}
                            <td id="bal-{{ Qs::hash($uc->id) }}" class="text-danger font-weight-bold">{{ $uc->balance ?: $uc->payment->amount }}</td>

                            {{--Pay Now Form--}}
                            <td>
                                <form id="{{ Qs::hash($uc->id) }}" method="post" class="ajax-pay" action="{{ route('payments.pay_now', Qs::hash($uc->id)) }}">
                                    @csrf
                             <div class="row">
                                 <div class="col-md-7">
                                     <input min="1" max="{{ $uc->balance ?: $uc->payment->amount }}" id="val-{{ Qs::hash($uc->id) }}" class="form-control" required placeholder="{{ __('payments.pay_now_placeholder') }}" title="{{ __('payments.pay_now_title') }}" name="amt_paid" type="number">
                                 </div>
                                 <div class="col-md-5">
                                     <button data-text="{{ __('payments.pay_now') }}" class="btn btn-danger" type="submit">{{ __('payments.pay_now') }} <i class="icon-paperplane ml-2"></i></button>
                                 </div>
                             </div>
                                </form>
                            </td>
                            {{--Receipt No--}}
                            <td>{{ $uc->ref_no }}</td>

                            <td>{{ $uc->year }}</td>

                            {{--Action--}}
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">

                                            {{--Reset Payment--}}
                                            <a id="{{ Qs::hash($uc->id) }}" onclick="confirmReset(this.id)" href="#" class="dropdown-item"><i class="icon-reset"></i> {{ __('payments.reset_payment') }}</a>
                                            <form method="post" id="item-reset-{{ Qs::hash($uc->id) }}" action="{{ route('payments.reset_record', Qs::hash($uc->id)) }}" class="hidden">@csrf @method('delete')</form>

                                            {{--Receipt--}}
                                                <a target="_blank" href="{{ route('payments.receipts', Qs::hash($uc->id)) }}" class="dropdown-item"><i class="icon-printer"></i> {{ __('payments.print_receipt') }}</a>
                                            {{--PDF Receipt--}}
                            {{--                    <a  href="{{ route('payments.pdf_receipts', Qs::hash($uc->id)) }}" class="dropdown-item download-receipt"><i class="icon-download"></i> Download Receipt</a>--}}

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="all-cl">
                <table class="table datatable-button-html5-columns table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('payments.title') }}</th>
                        <th>{{ __('payments.pay_ref') }}</th>
                        <th>{{ __('payments.amount') }}</th>
                        <th>{{ __('payments.receipt_no') }}</th>
                        <th>{{ __('payments.year') }}</th>
                        <th>{{ __('payments.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cleared as $cl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cl->payment->title }}</td>
                            <td>{{ $cl->payment->ref_no }}</td>

                            {{--Amount--}}
                            <td class="font-weight-bold">{{ $cl->payment->amount }}</td>
                            {{--Receipt No--}}
                            <td>{{ $cl->ref_no }}</td>

                            <td>{{ $cl->year }}</td>

                            {{--Action--}}
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">

                                            {{--Reset Payment--}}
                                            <a id="{{ Qs::hash($cl->id) }}" onclick="confirmReset(this.id)" href="#" class="dropdown-item"><i class="icon-reset"></i> {{ __('payments.reset_payment') }}</a>
                                            <form method="post" id="item-reset-{{ Qs::hash($cl->id) }}" action="{{ route('payments.reset_record', Qs::hash($cl->id)) }}" class="hidden">@csrf @method('delete')</form>

                                            {{--Receipt--}}
                                            <a target="_blank" href="{{ route('payments.receipts', Qs::hash($cl->id)) }}" class="dropdown-item"><i class="icon-printer"></i> {{ __('payments.print_receipt') }}</a>

                                            {{--PDF Receipt--}}
                                            {{--                    <a  href="{{ route('payments.pdf_receipts', Qs::hash($uc->id)) }}" class="dropdown-item download-receipt"><i class="icon-spinner2"></i> {{ __('payments.download_receipt') }}</a>--}}

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        </div>
    </div>

    {{--Payments Invoice List Ends--}}

@endsection
