<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">{{ $label or 'Изображение' }}</label>
    <span class="help">{!! $help or 'jpeg или png; менее, чем 4 МБ' !!}</span><br />
    <img class="image-preview" src="{{ isset($link) && $link !== null ? $link : image_url() }}" data-src="{{ isset($link) && $link !== null ? $link : image_url() }}" data-placeholder="{{ image_url() }}" />
    <input name="{{ $name }}" type="file" class="file-input image-input" />
</div>