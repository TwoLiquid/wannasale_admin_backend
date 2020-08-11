<div class="form-group form-group-default {{ isset($required) && $required ? 'required' : '' }}">
    <label>
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <textarea name="{{ $name or '' }}" class="form-control {{ isset($editor) && $editor ? 'redactor' : '' }}" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} style="{{ isset($style) ? $style : '' }}">{!! $value or '' !!}</textarea>
</div>