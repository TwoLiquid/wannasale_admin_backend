<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <span class="help">{!! $help or '' !!}</span>
    <input name="{{ $name or '' }}" value="{{ $value or '' }}" type="email" class="form-control" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
</div>