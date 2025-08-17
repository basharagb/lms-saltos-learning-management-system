@extends('layouts.master')
@section('page_title', 'الخدمات المالية')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><i class="icon-cash2 mr-2"></i> الخدمات المالية</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="icon-credit-card icon-3x mb-3"></i>
                        <h5>دفع الرسوم</h5>
                        <p>دفع الرسوم الدراسية</p>
                        <button class="btn btn-light">اذهب</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="icon-file-text icon-3x mb-3"></i>
                        <h5>كشف الحساب</h5>
                        <p>عرض كشف الحساب المالي</p>
                        <button class="btn btn-light">اذهب</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="icon-printer icon-3x mb-3"></i>
                        <h5>طباعة الإيصالات</h5>
                        <p>طباعة إيصالات الدفع</p>
                        <button class="btn btn-light">اذهب</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
