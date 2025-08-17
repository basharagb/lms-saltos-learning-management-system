@extends('layouts.master')
@section('page_title', 'التعلم الإلكتروني')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><i class="icon-laptop mr-2"></i> التعلم الإلكتروني</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="icon-video-camera icon-3x mb-3"></i>
                        <h5>الدروس المسجلة</h5>
                        <p>مشاهدة الدروس المسجلة</p>
                        <button class="btn btn-light">اذهب</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="icon-file-pdf icon-3x mb-3"></i>
                        <h5>المواد التعليمية</h5>
                        <p>تحميل المواد التعليمية</p>
                        <button class="btn btn-light">اذهب</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="icon-chat icon-3x mb-3"></i>
                        <h5>المناقشات</h5>
                        <p>المشاركة في المناقشات</p>
                        <button class="btn btn-light">اذهب</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
