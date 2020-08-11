<div class="form-group">
    <label class="m-b-0 {{ isset($required) && $required ? 'required' : '' }}">
        {{ $label or 'Файл' }}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>
    <span class="help">{!! $help or 'до 50 МБ' !!}</span><br />
    @if(isset($link) && $link)
        <a href="{{ $link }}" target="_blank" class="inline m-b-5">{{ isset($filename) && $filename ? $filename : 'Загруженный файл' }}</a><br />
    @endif
    <input name="{{ $name }}" type="file" class="file-input" title="{{ isset($link) && $link ? 'Заменить' : 'Выбрать' }}" />
</div>
