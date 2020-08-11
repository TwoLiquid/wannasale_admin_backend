<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <div class="input-group">
        @if(! isset($before) || $before)
            <span class="input-group-addon">{!! $addon or '' !!}</span>
        @endif
            <input name="{{ $name or '' }}" value="{{ $value or '' }}" type="{{ $type or 'text' }}" class="form-control" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
        @if(isset($before) && ! $before)
            <span class="input-group-addon">{!! $addon or '' !!}</span>
        @endif
    </div>
</div>