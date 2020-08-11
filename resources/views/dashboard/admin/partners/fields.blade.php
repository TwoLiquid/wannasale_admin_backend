@php /** @var \App\Models\Admin $admin */ @endphp
<div class="row">

    <div class="col-md-7">
        @component('dashboard.layouts.partials.card')
            @slot('cardTitle')
                Основные данные
            @endslot

            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Имя',
                'name' => 'name',
                'required' => true,
                'value' => old('name', isset($admin) ? $admin->name : ''),
                'placeholder' => 'Введите имя пользователя'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'E-mail',
                'name' => 'email',
                'required' => true,
                'value' => old('email', isset($admin) ? $admin->email : ''),
                'placeholder' => 'Введите e-mail пользователя'
            ])
        @endcomponent
    </div>
</div>
