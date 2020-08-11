<div class="checkbox check-{{ $color or 'success' }} m-t-15 m-l-10">
    <input id="{{ isset($id) ? $id : 'checkbox' . studly_case(isset($name) ? $name : '') }}" name="{{ $name or '' }}" type="checkbox" {{ isset($checked) && $checked ? 'checked=checked' : '' }} value="{{ isset($value) ? $value : 1 }}" />
    <label for="{{ isset($id) ? $id : 'checkbox' . studly_case(isset($name) ? $name : '') }}">{!! $title or '' !!}</label>
</div>