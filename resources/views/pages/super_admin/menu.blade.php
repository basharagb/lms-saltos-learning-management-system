@extends('layouts.super_admin')
@section('page_title', 'قائمة المشرف العام')
@section('content')

<div class="content">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-cog3 mr-2"></i> إعدادات النظام</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="list-group">
                        <a href="{{ route('settings') }}" class="list-group-item list-group-item-action {{ (Route::is('settings')) ? 'active' : '' }}">
                            <i class="icon-gear"></i> <span>الإعدادات</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--إدارة الرموز السرية--}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-lock2"></i> إدارة الرموز السرية</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="{{ route('pins.create') }}" class="list-group-item list-group-item-action {{ (Route::is('pins.create')) ? 'active' : '' }}">
                            <i class="icon-plus2"></i> إنشاء رموز سرية
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="{{ route('pins.index') }}" class="list-group-item list-group-item-action {{ (Route::is('pins.index')) ? 'active' : '' }}">
                            <i class="icon-eye"></i> عرض الرموز السرية
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--إدارة المستخدمين--}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-users mr-2"></i> إدارة المستخدمين</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action {{ (Route::is('users.index')) ? 'active' : '' }}">
                            <i class="icon-list"></i> قائمة المستخدمين
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="{{ route('users.create') }}" class="list-group-item list-group-item-action {{ (Route::is('users.create')) ? 'active' : '' }}">
                            <i class="icon-plus2"></i> إضافة مستخدم جديد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--إدارة الفصول الدراسية--}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-graduation2 mr-2"></i> إدارة الفصول الدراسية</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="{{ route('classes.index') }}" class="list-group-item list-group-item-action {{ (Route::is('classes.index')) ? 'active' : '' }}">
                            <i class="icon-list"></i> قائمة الفصول الدراسية
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="{{ route('classes.create') }}" class="list-group-item list-group-item-action {{ (Route::is('classes.create')) ? 'active' : '' }}">
                            <i class="icon-plus2"></i> إضافة فصل دراسي جديد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection