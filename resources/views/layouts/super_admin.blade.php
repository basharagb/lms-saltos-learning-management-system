<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="CJ Inspired">

    <title> @yield('page_title') | {{ config('app.name') }} </title>

    @include('partials.inc_top')
</head>

<body class="{{ in_array(Route::currentRouteName(), ['payments.invoice', 'marks.tabulation', 'marks.show', 'ttr.manage', 'ttr.show']) ? 'sidebar-xs' : '' }}">

@include('partials.top_menu')
<div class="page-content">
    {{-- Super Admin specific sidebar --}}
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->

        <!-- Sidebar content -->
        <div class="sidebar-content">
            <!-- User menu -->
            @if(Auth::check())
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                                <div class="media-subtitle opacity-75">
                                    <i class="icon-user font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}
                                </div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="{{ route('login') }}"><img src="{{ asset('global_assets/images/placeholders/user.png') }}" width="38" height="38" class="rounded-circle" alt="photo"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">زائر</div>
                                <div class="media-subtitle opacity-75">
                                    <i class="icon-user font-size-sm"></i> &nbsp;Guest
                                </div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="{{ route('login') }}" class="text-white"><i class="icon-login"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- /user menu -->

            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <!-- Main -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="icon-home4"></i>
                            <span>لوحة التحكم الرئيسية</span>
                        </a>
                    </li>

                    <!-- Super Admin specific menu items -->
                    <li class="nav-item">
                        <a href="{{ route('super_admin.menu') }}" class="nav-link {{ Route::is('super_admin.menu') ? 'active' : '' }}">
                            <i class="icon-cog3"></i>
                            <span>قائمة المشرف العام</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('settings') }}" class="nav-link {{ Route::is('settings') ? 'active' : '' }}">
                            <i class="icon-gear"></i>
                            <span>الإعدادات</span>
                        </a>
                    </li>

                    <!-- Personal Profile -->
                    <li class="nav-item">
                        <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}">
                            <i class="icon-user"></i>
                            <span>الملف الشخصي</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i>
                            <span>تسجيل الخروج</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        @include('partials.header')

        <div class="content">
            {{--Error Alert Area--}}
            @if($errors->any())
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                        @foreach($errors->all() as $er)
                            <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                        @endforeach

                </div>
            @endif
            <div id="ajax-alert" style="display: none"></div>

            @yield('content')
        </div>
    </div>
</div>

@include('partials.inc_bottom')
@yield('scripts')
</body>
</html>
