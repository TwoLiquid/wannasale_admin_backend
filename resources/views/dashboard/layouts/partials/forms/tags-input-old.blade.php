<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <span class="help">{!! $help or '' !!}</span>
    <input type="hidden" class="select2tags" name="{{ $name or '' }}" data-source="{{ $source or '' }}" data-placeholder="{{ $placeholder or '' }}" value="{{ $value or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
</div>