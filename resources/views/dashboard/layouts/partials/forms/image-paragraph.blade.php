<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">{{ $label or 'Изображение' }}</label>
    <span class="help">{!! $help or 'jpeg или png; менее, чем 4 МБ' !!}</span><br />
    <img class="image-preview" src="{{ isset($value) && $value !== null && ! old('remove_'.$name) ? $value : dashboard_placeholder_image() }}" data-src="{{ isset($value) && $value !== null ? $value : dashboard_placeholder_image() }}" data-placeholder="{{ dashboard_placeholder_image() }}" />
    @if(isset($value) && $value !== null)
        <div class="checkbox check-warning">
            <input name="remove_{{ $name }}" id="remove{{ studly_case($name) }}" {{ old('remove_'.$name) == 1 ? 'checked=checked' : '' }} class="remove-image-checkbox" type="checkbox" value="1">
        </div>
    @endif
</div>
