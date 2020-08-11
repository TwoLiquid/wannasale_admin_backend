<div class="form-group">
    <label class="m-b-0 {{ isset($required) && $required ? 'required' : '' }}">
        {{ $label or 'Файл' }}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <span class="help">{!! $help or 'до 50 МБ' !!}</span><br />
    @if(isset($link) && $link)
        <a href="{{ $link }}" target="_blank" class="inline m-b-5">{{ isset($filename) && $filename ? $filename : 'Загруженный файл' }}</a>
        <div class="checkbox check-warning m-t-0 m-b-5">
            <input name="remove_{{ $name }}" id="remove{{ studly_case($name) }}" {{ old('remove_'.$name) == 1 ? 'checked=checked' : '' }} class="remove-file-checkbox" type="checkbox" value="1">
            <label for="remove{{ studly_case($name) }}" class="fs-10">Удалить файл</label>
        </div>
    @endif
    <input name="{{ $name }}" type="file" class="file-input {{ old('remove_'.$name) == 1 ? 'disabled' : '' }}" title="{{ isset($link) && $link ? 'Заменить' : 'Выбрать' }}" />
</div>
