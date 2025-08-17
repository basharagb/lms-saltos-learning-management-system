<div class="navbar navbar-expand-md navbar-dark">
    <div class="mt-2 mr-5">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
            <div class="d-flex align-items-center">
                <div class="university-logo-header ml-3">
                    <div style="background: var(--university-white); border-radius: 8px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                        <i class="icon-graduation2" style="font-size: 1.8rem; color: var(--university-primary);"></i>
                    </div>
                </div>
                <div>
                    <h4 class="text-bold text-white mb-0" style="font-weight: 700;">{{ Qs::getSystemName() }}</h4>
                    <small class="text-white-50">نظام إدارة الطلاب الجامعي</small>
                </div>
            </div>
        </a>
    </div>
  {{--  <div class="navbar-brand">
        <a href="index.html" class="d-inline-block">
            <img src="{{ asset('global_assets/images/logo_light.png') }}" alt="">
        </a>
    </div>--}}

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>


        </ul>

			<span class="navbar-text ml-md-3 mr-md-auto"></span>

        <ul class="navbar-nav">

            @if(Auth::check())
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img style="width: 38px; height:38px;" src="{{ Auth::user()->photo ?? asset('global_assets/images/placeholders/user.png') }}" class="rounded-circle" alt="photo">
                    <span>{{ Auth::user()->name ?? 'User' }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ Qs::userIsStudent() ? route('students.show', Qs::hash(Qs::findStudentRecord(Auth::user()->id)->id)) : route('users.show', Qs::hash(Auth::user()->id)) }}" class="dropdown-item"><i class="icon-user-plus"></i> ملفي الشخصي</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-cog5"></i> إعدادات الحساب</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> تسجيل الخروج</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="navbar-nav-link">
                    <i class="icon-user"></i>
                    <span>تسجيل الدخول</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
