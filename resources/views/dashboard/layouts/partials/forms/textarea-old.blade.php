<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <span class="help">{!! $help or '' !!}</span>
    <textarea name="{{ $name or '' }}" class="form-control {{ isset($editor) && $editor ? 'redactor' : '' }}" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }}>{!! $value or '' !!}</textarea>
</div>