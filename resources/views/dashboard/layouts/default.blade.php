<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('dashboard.layouts.meta')

    <title>
        @yield('title') :: Административная панель
    </title>

    @include('dashboard.layouts.styles')

</head>
<body class="fixed-header">
    @stack('body-top')

    @include('dashboard.layouts.alerts')

    @include('dashboard.layouts.modals')

    @include('dashboard.layouts.sidebar')

    <!-- START PAGE-CONTAINER -->
    <div class="page-container">

        @include('dashboard.layouts.header')

        <div class="page-content-wrapper">

            <div class="content">
                <div class="container-fluid container-fixed-lg">
                    <div class="inner">

                        @yield('breadcrumb')

                        <h4 class="page-title">

                            @yield('title')

                            @yield('after-title')

                        </h4>
                    </div>
                </div>
                <div class="container-fluid container-fixed-lg p-b-30">

                    @yield('content')

                </div>
            </div>

            @include('dashboard.layouts.footer')

        </div>

    </div>

    @include('dashboard.layouts.scripts')

    @stack('scripts')

</body>
</html>
