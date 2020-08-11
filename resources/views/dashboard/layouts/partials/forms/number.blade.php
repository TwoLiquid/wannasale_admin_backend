<div class="form-group {{ $class or '' }} form-group-default {{ isset($required) && $required ? 'required' : '' }}">
    <label>
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <input name="{{ $name or '' }}" value="{{ $value or '' }}" type="number" min="{{ $min or '-99999999' }}" max="{{ $max or '99999999' }}" step="{{ $step or '0.01' }}" class="form-control" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
</div>
@if(isset($note))
    <div class="fs-11 hint-text p-l-15 m-b-10" style="margin-top: -8px;">{!! $note !!}</div>
@endif