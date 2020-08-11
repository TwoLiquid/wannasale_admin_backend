<div class="form-group form-group-default {{ isset($required) && $required ? 'required' : '' }}">
    <label>
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <input name="{{ $name or '' }}" value="{{ $value or '' }}" type="password" class="form-control" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
</div>