<div class="form-group form-group-default form-group-default-select2 {{ isset($required) && $required ? 'required' : '' }}">
    <label>
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    @php
        $dataAttributes = '';
        if (isset($data) && is_array($data) && count($data) > 0) {
            foreach ($data as $dataAttrName => $dataAttrValue) {
                if ($dataAttrValue !== '') {
                    $dataAttributes .= 'data-' . $dataAttrName . '=' . $dataAttrValue . ' ';
                }
            }
        }
    @endphp
    <select {{ isset($id) ? 'id=' . $id : '' }} title="{!! $title or '' !!}" name="{{ $name or '' }}" class="full-width" data-init-plugin="select2" multiple {{ $dataAttributes }} data-placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} {{ isset($disabled) && $disabled ? 'disabled' : '' }}>
        @if(isset($optionsRaw))
            {!! $optionsRaw !!}
        @elseif(isset($options) && is_array($options))
            @foreach($options as $optValue => $optName)
                <option value="{{ $optValue }}" {{ (isset($selected) && is_array($selected) ? in_array($optValue, $selected) : false) ? 'selected' : '' }}>{{ $optName }}</option>
            @endforeach
        @endif
    </select>
</div>