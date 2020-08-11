<div class="pgn-wrapper" data-position="top">
    <div class="pgn push-on-sidebar-open pgn-bar">
        <div class="alert alert-success">
            <div class="container">
                {{ $slot }}
                @include('dashboard.layouts.partials.alert-close-button')
            </div>
        </div>
    </div>
</div>
