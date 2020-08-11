<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">{{ $label or 'Изображение' }}</label>
    <span class="help">{!! $help or 'jpeg или png; менее, чем 4 МБ' !!}</span><br />
    <img class="image-preview" src="{{ isset($link) && $link !== null && ! old('remove_'.$name) ? $link : image_url() }}" data-src="{{ isset($link) && $link !== null ? $link : image_url() }}" data-placeholder="{{ image_url() }}" />
    @if(isset($original) && $original !== null)
        <div class="m-l-4 p-b-6">
            <a href="{{ $original }}" class="" target="_blank">Оригинал <i class="fa fa-external-link fs-11 m-l-3"></i></a>
        </div>
    @endif
    @if(isset($link) && $link !== null)
        <div class="checkbox check-warning">
            <input name="remove_{{ $name }}" id="remove{{ studly_case($name) }}" {{ old('remove_'.$name) == 1 ? 'checked=checked' : '' }} class="remove-image-checkbox" type="checkbox" value="1">
            <label for="remove{{ studly_case($name) }}">Удалить изображение</label>
        </div>
    @endif
    <input name="{{ $name }}" type="file" class="file-input image-input {{ old('remove_'.$name) == 1 ? 'disabled' : '' }}" />
</div>
