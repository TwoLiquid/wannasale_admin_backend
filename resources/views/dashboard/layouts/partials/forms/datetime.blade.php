<div class="form-group form-group-default input-group {{ isset($required) && $required ? 'required' : '' }}">
    <div class="form-input-group">
        <label>
            {!! $title or '' !!}
            @if(isset($lang))
                @include('dashboard.layouts.partials.'.$lang.'-label')
            @endif
        </label>
        <input name="{{ $name or '' }}" value="{{ $value or '' }}" class="form-control datetimepicker" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
    </div>
    <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
    </div>
</div>