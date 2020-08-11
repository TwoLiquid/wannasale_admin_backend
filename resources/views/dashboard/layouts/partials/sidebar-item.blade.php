<li class="{{ starts_with(Route::currentRouteName(), $routeRoot) ? 'open active' : '' }}">
    @if(isset($links) && $links)
        <a href="javascript:" {!! isset($details) && $details ? 'class=detailed' : '' !!}>
            <span class="title">{!! $name !!}</span>
            @if(isset($details) && $details)
                <span class="details">{!! $details !!}</span>
            @endif
            <span class="arrow {{ starts_with(Route::currentRouteName(), $routeRoot) ? 'open active' : '' }}"></span>
        </a>
    @else
        <a href="{{ isset($route) ? route($route) : '' }}" {!! isset($details) && $details ? 'class=detailed' : '' !!}>
            <span class="title">{!! $name !!}</span>
            @if(isset($details) && $details)
                <span class="details">{!! $details !!}</span>
            @endif
        </a>
    @endif
    <span class="icon-thumbnail">
        @if(isset($iconClass))
            <i class="{{ $iconClass }}"></i>
        @elseif(isset($featherIcon))
            <i data-feather="{{ $featherIcon }}"></i>
        @endif
    </span>
    @if(isset($links) && $links)
        <ul class="sub-menu">
            @foreach($links as $link)
                @if(! array_key_exists('sublinks', $link))
                    <li class="{{ Route::currentRouteName() == $link['route'] ? 'active' : '' }}">
                        <a href="{{ route($link['route'], isset($link['parameters']) ? $link['parameters'] : []) }}">{!! $link['name'] !!}</a>
                        <span class="icon-thumbnail">
                            @if(isset($link['iconClass']))
                                <i class="{{ $link['iconClass'] }}"></i>
                            @elseif(isset($link['featherIcon']))
                                <i data-feather="{{ $link['featherIcon'] }}"></i>
                            @endif
                        </span>
                    </li>
                @else
                    <li class="{{ starts_with(Route::currentRouteName(), $link['routeRoot']) ? 'open active' : '' }}">
                        <a href="javascript:"><span class="title">{!! $link['name'] !!}</span>
                            <span class="arrow {{ starts_with(Route::currentRouteName(), $link['routeRoot']) ? 'open active' : '' }}"></span>
                        </a>
                        <span class="icon-thumbnail">
                            @if(isset($link['iconClass']))
                                <i class="{{ $link['iconClass'] }}"></i>
                            @elseif(isset($link['featherIcon']))
                                <i data-feather="{{ $link['featherIcon'] }}"></i>
                            @endif
                        </span>
                        <ul class="sub-menu" style="{{ starts_with(Route::currentRouteName(), $link['routeRoot']) ? 'display:block' : '' }}">
                            @foreach($link['sublinks'] as $sublink)
                                <li class="{{ Route::currentRouteName() == $sublink['route'] ? 'active' : '' }}">
                                    <a href="{{ route($sublink['route'], isset($sublink['parameters']) ? $sublink['parameters'] : []) }}">{{ $sublink['name'] }}</a>
                                    <span class="icon-thumbnail">
                                        @if(isset($sublink['letters']))
                                            {{ $sublink['letters'] }}
                                        @elseif(isset($sublink['iconClass']))
                                            <i class="{{ $sublink['iconClass'] }}"></i>
                                        @elseif(isset($sublink['featherIcon']))
                                            <i data-feather="{{ $sublink['featherIcon'] }}"></i>
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</li>
