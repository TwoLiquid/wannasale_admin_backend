<!-- START HEADER -->
<div class="header ">
    <!-- START MOBILE SIDEBAR TOGGLE -->
    <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu" data-toggle="sidebar">
    </a>
    <!-- END MOBILE SIDEBAR TOGGLE -->
    <div>
        <div class="brand inline">
            <img class="m-l-66" src="{{ asset('assets/dashboard/img/logo.png') }}" alt="logo" data-src="{{ asset('assets/dashboard/img/logo.png') }}" data-src-retina="{{ asset('assets/dashboard/img/logo.png') }}" height="26" />
        </div>
    </div>
    <div class="d-flex align-items-center">
        <!-- START User Info-->
        <div class="dropdown pull-right hidden-md-down">
            <button class="profile-dropdown-toggle c-p" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="semi-bold hint-text">{{ auth('dashboard')->user()->name }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">

                <a href="{{ route('dashboard.logout') }}" class="clearfix bg-master-lighter dropdown-item">
                    <span class="pull-left">Выйти</span>
                    <span class="pull-right"><i class="pg-power"></i></span>
                </a>
            </div>
        </div>
        <!-- END User Info-->
    </div>
</div>
<!-- END HEADER -->
