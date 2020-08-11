<div class="form-group">
    <label class="{{ isset($required) && $required ? 'required' : '' }}">{!! $title or '' !!}</label>
    <span class="help">можно выбрать несколько</span>
    <div class="input-group">
        <select id="tagsSelect" class="select2" name="{{ $name or 'tags[]' }}" data-placeholder="{{ $placeholder or '' }}" multiple {{ isset($required) && $required ? 'required' : '' }}>
            @if(isset($options) && is_array($options))
                @foreach($options as $optValue => $optName)
                    <option value="{{ $optValue }}" {{ (isset($selected) && is_array($selected) ? in_array($optValue, $selected) : false) ? 'selected' : '' }}>{{ $optName }}</option>
                @endforeach
            @endif
        </select>
        <div class="input-group-btn">
            <div id="show-tag-btn" class="btn btn-success" type="button"><i class="fa fa-plus"></i></div>
        </div>
    </div>
</div>
<div id="add-tag-block" class="card card-info" style="display: none;">
    <div class="card-header">
        <div id="add-tag-btn" class="btn btn-primary btn-sm pull-right">Добавить</div>
        <h3 class="card-title">Добавление тега</h3>
    </div>
    <div class="card-block">
        <div data-url="{{ route('dashboard.tags.store') }}" id="add-tag-form">
            <div class="clearfix"></div>
            <div class="alert alert-error m-t-5 m-b-10" style="display: none;"></div>
            <div class="row">
                <div class="col-md-6">
                    @include('dashboard.layouts.partials.forms.text-old', [
                         'title' => 'Текст',
                         'name' => 'ru[value]',
                         'lang' => 'ru',
                         'placeholder' => 'Введите тег'
                    ])
                </div>
                <div class="col-md-6">
                    @include('dashboard.layouts.partials.forms.text-old', [
                        'title' => 'Текст',
                        'name' => 'en[value]',
                        'lang' => 'en',
                        'placeholder' => 'Введите тег'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>