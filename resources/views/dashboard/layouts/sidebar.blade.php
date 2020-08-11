<!-- BEGIN SIDEBAR -->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu"></div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{ asset('assets/dashboard/img/logo.png') }}" alt="logo" class="brand" data-src="{{ asset('assets/dashboard/img/logo.png') }}" data-src-retina="{{ asset('assets/dashboard/img/logo.png') }}" height="26" />
        <div class="sidebar-header-controls">
            <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline m-l-36" type="button" style=""><i class="fa fs-12"></i></button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items p-t-20 p-b-30">

            @if(auth(GUARD_DASHBOARD)->user()->is_super === true)

                @include('dashboard.layouts.partials.sidebar-item', [
                    'name' => 'Тарифы',
                    'routeRoot' => ['dashboard.admin.rates'],
                    'featherIcon' => 'file',
                    'links' => [
                        [
                            'name' => 'Список',
                            'route' => 'dashboard.admin.rates',
                            'featherIcon' => 'list'
                        ],
                        [
                            'name' => 'Создать',
                            'route' => 'dashboard.admin.rates.create',
                            'featherIcon' => 'plus'
                        ]
                    ]
                ])

                @include('dashboard.layouts.partials.sidebar-item', [
                    'name' => 'Партнеры',
                    'routeRoot' => ['dashboard.admin.partners'],
                    'featherIcon' => 'users',
                    'links' => [
                        [
                            'name' => 'Список',
                            'route' => 'dashboard.admin.partners',
                            'featherIcon' => 'list'
                        ],
                        [
                            'name' => 'Создать',
                            'route' => 'dashboard.admin.partners',
                            'featherIcon' => 'plus'
                        ]
                    ]
                ])

                @include('dashboard.layouts.partials.sidebar-item', [
                    'name' => 'Компании',
                    'routeRoot' => ['dashboard.admin.vendors'],
                    'featherIcon' => 'briefcase',
                    'links' => [
                        [
                            'name' => 'Список',
                            'route' => 'dashboard.admin.vendors',
                            'featherIcon' => 'list'
                        ],
                        [
                            'name' => 'Создать',
                            'route' => 'dashboard.admin.vendors.create',
                            'featherIcon' => 'plus'
                        ]
                    ]
                ])
            @else
                @include('dashboard.layouts.partials.sidebar-item', [
                    'name' => 'Компании',
                    'routeRoot' => ['dashboard.partner.vendors'],
                    'featherIcon' => 'briefcase',
                    'links' => [
                        [
                            'name' => 'Список',
                            'route' => 'dashboard.partner.vendors',
                            'featherIcon' => 'list'
                        ],
                        [
                            'name' => 'Создать',
                            'route' => 'dashboard.partner.vendors.create',
                            'featherIcon' => 'plus'
                        ]
                    ]
                ])

                @include('dashboard.layouts.partials.sidebar-item', [
                    'name' => 'Запросы',
                    'routeRoot' => ['dashboard.partner.requests'],
                    'featherIcon' => 'briefcase',
                    'links' => [
                        [
                            'name' => 'Список',
                            'route' => 'dashboard.partner.requests',
                            'featherIcon' => 'list'
                        ]
                    ]
                ])
            @endif

            {{--@include('dashboard.layouts.partials.sidebar-item', [--}}
                {{--'name' => 'Главная страница',--}}
                {{--'routeRoot' => 'dashboard.index',--}}
                {{--'route' => 'dashboard.index',--}}
                {{--'featherIcon' => 'home'--}}
            {{--])--}}

            {{--@include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Компании',
                'routeRoot' => ['dashboard.vendors'],
                'featherIcon' => 'briefcase',
                'links' => [
                    [
                        'name' => 'Список',
                        'route' => 'dashboard.vendors',
                        'featherIcon' => 'list'
                    ],
                    [
                        'name' => 'Создать',
                        'route' => 'dashboard.vendors.create',
                        'featherIcon' => 'plus'
                    ]
                ]
            ])

            @include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Пользователи',
                'routeRoot' => ['dashboard.users'],
                'featherIcon' => 'users',
                'links' => [
                    [
                        'name' => 'Список',
                        'route' => 'dashboard.users',
                        'featherIcon' => 'list'
                    ],
                    [
                        'name' => 'Создать',
                        'route' => 'dashboard.users.create',
                        'featherIcon' => 'plus'
                    ]
                ]
            ])--}}

        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
