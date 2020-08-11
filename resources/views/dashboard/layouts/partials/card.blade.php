<div id="{{ isset($cardId) ? $cardId : '' }}" class="card card-default {{ isset($cardCollapsed) && $cardCollapsed ? 'card-collapsed' : '' }}" data-pages="card">
    @if(isset($cardTitle) || isset($cardHeader))
        <div class="card-header">

            @if(isset($cardTitle))
                <div class="card-title fs-11">{!! $cardTitle !!}</div>
            @endif

            @if(isset($cardHeader))
                {!! $cardHeader !!}
            @endif

            @if(isset($cardCollapsed) && $cardCollapsed)
                <div class="card-controls">
                    <ul>
                        <li><a href="#" class="card-collapse" data-toggle="collapse"><i class="pg-arrow_minimize"></i></a></li>
                    </ul>
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
    @endif
    <div class="card-block" style="{{ isset($cardCollapsed) && $cardCollapsed ? 'display: none' : '' }}">

        {!! $slot !!}

    </div>
</div>
