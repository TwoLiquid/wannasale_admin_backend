<div class="radio radio-{{ $color or 'success' }} m-l-5">
    @if(isset($options) && is_array($options))
        @foreach($options as $optValue => $optName)
            <input type="radio" {{ (isset($checked) ? $checked : '') == $optValue ? 'checked=checked' : '' }} value="{{ $optValue }}" name="{{ $name or '' }}" id="{{ studly_case((isset($id) ? $id : 'radio' . (isset($name) ? $name : '')) . '_' . $optValue) }}" {{ isset($disabled) && $disabled === true ? 'disabled' : '' }}>
            <label for="{{ studly_case((isset($id) ? $id : 'radio' . (isset($name) ? $name : '')) . '_' . $optValue) }}">
                {{ $optName }}
                @if(isset($lang))
                    @include('dashboard.layouts.partials.'.$lang.'-label')
                @endif
            </label>
            @if(! $loop->last && ! (isset($inline) && $inline))
                <br />
            @endif
        @endforeach
    @endif
</div>