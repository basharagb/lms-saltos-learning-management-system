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
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>لوحة التحكم الرئيسية</span>
                    </a>
                </li>

                <!-- Student Portal -->
                @if(Qs::userIsStudent())
                <li class="nav-item">
                    <a href="{{ route('student_portal.index') }}" class="nav-link {{ (Route::is('student_portal.*')) ? 'active' : '' }}">
                        <i class="icon-graduation2"></i>
                        <span>البوابة الطلابية</span>
                    </a>
                </li>
                @endif

                {{--Academic Affairs--}}
                @if(Qs::userIsAcademic())
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['tt.index', 'ttr.edit', 'ttr.show', 'ttr.manage']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span> الشؤون الأكاديمية</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="إدارة الشؤون الأكاديمية">

                        {{--Timetables--}}
                            <li class="nav-item"><a href="{{ route('tt.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['tt.index']) ? 'active' : '' }}">الجداول الدراسية</a></li>
                        </ul>
                    </li>
                    @endif

                {{--Administrative Services--}}
                @if(Qs::userIsAdministrative())
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.invoice', 'payments.receipts', 'payments.edit', 'payments.manage', 'payments.show',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> الخدمات الإدارية</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="الخدمات الإدارية">

                            {{--Payments--}}
                            @if(Qs::userIsTeamAccount())
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.edit', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'nav-item-expanded' : '' }}">

                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.create', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'active' : '' }}">الرسوم الجامعية</a>

                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="{{ route('payments.create') }}" class="nav-link {{ Route::is('payments.create') ? 'active' : '' }}">Create Payment</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.show']) ? 'active' : '' }}">Manage Payments</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}">Student Payments</a></li>

                                </ul>

                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{--Manage Students--}}
                @if(Qs::userIsTeamSAT())
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['modern_students.index', 'modern_students.create', 'modern_students.show', 'students.create', 'students.list', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-users"></i> <span> إدارة الطلاب</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="إدارة الطلاب">
                            {{--Modern Student Management--}}
                            <li class="nav-item">
                                <a href="{{ route('modern_students.index') }}"
                                   class="nav-link {{ in_array(Route::currentRouteName(), ['modern_students.index', 'modern_students.show']) ? 'active' : '' }}">
                                   <i class="icon-graduation2"></i> إدارة الطلاب الحديثة</a>
                            </li>
                            {{--Admit Student--}}
                            @if(Qs::userIsTeamSA())
                                <li class="nav-item">
                                    <a href="{{ route('modern_students.create') }}"
                                       class="nav-link {{ (Route::is('modern_students.create')) ? 'active' : '' }}">
                                       <i class="icon-user-plus"></i> إضافة طالب جديد</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('students.create') }}"
                                       class="nav-link {{ (Route::is('students.create')) ? 'active' : '' }}">
                                       <i class="icon-plus2"></i> قبول طالب (تقليدي)</a>
                                </li>
                            @endif

                            {{--Student Information - Comprehensive Page--}}
                            <li class="nav-item">
                                <a href="{{ route('modern_students.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['modern_students.index', 'students.edit', 'students.show']) ? 'active' : '' }}">
                                    <i class="icon-users4"></i> معلومات الطلاب الشاملة</a>
                            </li>

                            @if(Qs::userIsTeamSA())

                            {{--Student Promotion--}}
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'nav-item-expanded' : '' }}">
                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage' ]) ? 'active' : '' }}">
                                    <i class="icon-arrow-up8"></i> ترقية الطلاب</a>
                            <ul class="nav nav-group-sub">
                                <li class="nav-item"><a href="{{ route('students.promotion') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion']) ? 'active' : '' }}">ترقية الطلاب</a></li>
                                <li class="nav-item"><a href="{{ route('students.promotion_manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion_manage']) ? 'active' : '' }}">إدارة الترقيات</a></li>
                            </ul>

                            </li>

                            {{--Student Graduated--}}
                            <li class="nav-item"><a href="{{ route('students.graduated') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.graduated' ]) ? 'active' : '' }}">
                                <i class="icon-graduation"></i> الطلاب المتخرجون</a></li>
                                @endif

                        </ul>
                    </li>
                @endif

                @if(Qs::userIsTeamSA())
                    {{--Student Management--}}
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}"><i class="icon-users4"></i> <span> إدارة الطلاب والموظفين</span></a>
                    </li>

                    {{--Academic Programs--}}
                    <li class="nav-item">
                        <a href="{{ route('classes.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index','classes.edit']) ? 'active' : '' }}"><i class="icon-windows2"></i> <span> البرامج الأكاديمية</span></a>
                    </li>

                    {{--Student Housing--}}
                    <li class="nav-item">
                        <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="icon-home9"></i> <span> السكن الجامعي</span></a>
                    </li>

                    {{--Academic Departments--}}
                    <li class="nav-item">
                        <a href="{{ route('sections.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'active' : '' }}"><i class="icon-fence"></i> <span>الأقسام الأكاديمية</span></a>
                    </li>

                    {{--Course Management--}}
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'active' : '' }}"><i class="icon-pin"></i> <span>إدارة المقررات (تقليدي)</span></a>
                    </li>

                    {{--Modern Course Management--}}
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['courses.index', 'courses.create', 'courses.show', 'courses.edit', 'courses.enrollments']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-books"></i> <span>إدارة المقررات الحديثة</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="إدارة المقررات">
                            <li class="nav-item">
                                <a href="{{ route('courses.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['courses.index', 'courses.show']) ? 'active' : '' }}">
                                    <i class="icon-list"></i> قائمة المقررات
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('courses.create') }}" class="nav-link {{ Route::is('courses.create') ? 'active' : '' }}">
                                    <i class="icon-plus2"></i> إضافة مقرر جديد
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{--Assessment & Evaluation--}}
                @if(Qs::userIsTeamSAT())
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['exams.index', 'exams.edit', 'grades.index', 'grades.edit', 'marks.index', 'marks.manage', 'marks.bulk', 'marks.tabulation', 'marks.show', 'marks.batch_fix',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-books"></i> <span> التقييم والامتحانات</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="إدارة التقييم والامتحانات">
                        @if(Qs::userIsTeamSA())

                        {{--Exam Management--}}
                            <li class="nav-item">
                                <a href="{{ route('exams.index') }}"
                                   class="nav-link {{ (Route::is('exams.index')) ? 'active' : '' }}">إدارة الامتحانات</a>
                            </li>

                            {{--Grade Management--}}
                            <li class="nav-item">
                                    <a href="{{ route('grades.index') }}"
                                       class="nav-link {{ in_array(Route::currentRouteName(), ['grades.index', 'grades.edit']) ? 'active' : '' }}">إدارة الدرجات</a>
                            </li>

                            {{--Academic Transcripts--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.tabulation') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.tabulation']) ? 'active' : '' }}">كشوف الدرجات</a>
                            </li>

                            {{--Grade Corrections--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.batch_fix') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.batch_fix']) ? 'active' : '' }}">تصحيح الدرجات</a>
                            </li>
                        @endif

                        @if(Qs::userIsTeamSAT())
                            {{--Student Records--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.index') }}"
                                   class="nav-link {{ in_array(Route::currentRouteName(), ['marks.index']) ? 'active' : '' }}">السجلات الأكاديمية</a>
                            </li>

                            {{--Academic Reports--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.bulk') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.bulk', 'marks.show']) ? 'active' : '' }}">التقارير الأكاديمية</a>
                            </li>

                            @endif

                    </ul>
                </li>
                @endif


                {{--End Exam--}}

                @include('pages.'.Qs::getUserType().'.menu')

                {{--Personal Profile--}}
                <li class="nav-item">
                    <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i class="icon-user"></i> <span>الملف الشخصي</span></a>
                </li>

                </ul>
            </div>
        </div>
</div>
