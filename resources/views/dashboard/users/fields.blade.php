@php /** @var \App\Models\Admin $user */ @endphp
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
                'value' => old('name', isset($user) ? $user->name : ''),
                'placeholder' => 'Введите имя пользователя'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'E-mail',
                'name' => 'email',
                'required' => true,
                'value' => old('email', isset($user) ? $user->email : ''),
                'placeholder' => 'Введите e-mail пользователя'
            ])
            @include('dashboard.layouts.partials.forms.checkbox', [
                'title' => 'Подтверждён',
                'name' => 'approved',
                'checked' => old('approved', isset($user) ? $user->approved : false),
                'color' => 'complete'
            ])
        @endcomponent
    </div>
</div>
