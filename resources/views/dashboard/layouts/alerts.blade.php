@if(session()->has('success'))
    @component('dashboard.layouts.partials.alerts.success')
        <span>{!! session('success') !!}</span>
    @endcomponent
@endif

@if(session()->has('error'))
    @component('dashboard.layouts.partials.alerts.error')
        <span>{!! session('error') !!}</span>
    @endcomponent
@endif

@if(session()->has('errors'))
    @component('dashboard.layouts.partials.alerts.error')
        <ul>
            @foreach(session('errors')->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endcomponent
@endif

@if(session()->has('warning'))
    @component('dashboard.layouts.partials.alerts.warning')
        <span>{!! session('warning') !!}</span>
    @endcomponent
@endif
