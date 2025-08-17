<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="mt-2 mr-5">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
            <h4 class="text-bold text-white">{{ Qs::getSystemName() }}</h4>
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown dropdown-user h-100">
                <a href="#" class="navbar-nav-link dropdown-toggle d-flex h-100 align-items-center" data-toggle="dropdown">
                    <img src="{{ asset('global_assets/images/logo.png') }}" class="rounded mr-2" width="34" alt="">
                    <span class="d-md-none ml-2">الرئيسية</span>
                </a>
            </li>

            <li class="nav-item dropdown dropdown-user h-100">
                <a href="#" class="navbar-nav-link dropdown-toggle d-flex h-100 align-items-center" data-toggle="dropdown">
                    <img src="{{ asset('global_assets/images/logo.png') }}" class="rounded mr-2" width="34" alt="">
                    <span class="d-md-none ml-2">حسابي</span>
                </a>
            </li>

            <li class="nav-item dropdown dropdown-user h-100">
                <a href="#" class="navbar-nav-link dropdown-toggle d-flex h-100 align-items-center" data-toggle="dropdown">
                    <img src="{{ asset('global_assets/images/logo.png') }}" class="rounded mr-2" width="34" alt="">
                    <span class="d-md-none ml-2">الخيارات</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
