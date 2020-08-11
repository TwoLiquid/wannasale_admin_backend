@php /** @var \App\Models\Rate $item */ @endphp
<div class="row">

    <div class="col-md-7">
        @component('dashboard.layouts.partials.card')
            @slot('cardTitle')
                Основные данные
            @endslot

            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Название тарифа',
                'name' => 'name',
                'required' => true,
                'value' => old('name', isset($item) ? $item->name : ''),
                'placeholder' => 'Введите название тарифа'
            ])
            @include('dashboard.layouts.partials.forms.number', [
                'title' => 'Цена',
                'name' => 'price',
                'required' => true,
                'value' => old('price', isset($item) ? $item->price : ''),
                'placeholder' => 'Введите стоимость тарифа'
            ])
            @include('dashboard.layouts.partials.forms.checkbox', [
                'title'   => 'Основной тариф',
                'name'    => 'default',
                'checked' => isset($item) ? $item->default : false,
                'color'   => 'complete'
            ])
        @endcomponent
    </div>
</div>
