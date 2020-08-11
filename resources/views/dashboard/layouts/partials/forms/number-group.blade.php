<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <div class="input-group">
        @if(! isset($before) || $before)
            <div class="input-group-addon">{!! $addon or '' !!}</div>
        @endif
        <input name="{{ $name or '' }}" value="{{ $value or '' }}" type="{{ $type or 'text' }}" class="form-control" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
        @if(isset($before) && ! $before)
            <div class="input-group-addon">{!! $addon or '' !!}</div>
        @endif
    </div>
</div>


<div class="form-group form-group-default input-group">
    <div class="form-input-group">
        <label>Initial price</label>
        <input type="email" class="form-control">
    </div>
    <div class="input-group-addon">
        POSH
    </div>
</div>
