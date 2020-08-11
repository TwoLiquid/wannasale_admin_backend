<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">{!! $title or '' !!}</label>
    <select title="{!! $title or '' !!}" name="{{ $name or '' }}" class="full-width" data-init-plugin="select2" multiple="multiple" data-placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }}>
        @if(isset($optionsRaw))
            {!! $optionsRaw !!}
        @elseif(isset($options) && is_array($options))
            @foreach($options as $optValue => $optName)
                <option value="{{ $optValue }}" {{ (isset($selected) && is_array($selected) ? in_array($optValue, $selected) : false) ? 'selected' : '' }}>{{ $optName }}</option>
            @endforeach
        @endif
    </select>
</div>