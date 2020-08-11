<div class="form-group form-group-default {{ isset($required) && $required ? 'required' : '' }}">
    <label>
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <p>{{ $value }}</p>
</div>