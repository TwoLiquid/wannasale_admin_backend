@extends('dashboard.layouts.default')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список компаний' => route('dashboard.partner.vendors')
    ]])
@stop

@section('title', 'Изменение компании')

@section('content')

    @php /** @var \App\Models\Vendor $item */ @endphp
    <div class="row">

        <div class="col-md-7">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Основные данные
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.partner.vendors.edit', $item->id)])
                    @include('dashboard.layouts.partials.forms.text', [
                        'title' => 'Имя',
                        'name' => 'name',
                        'required' => true,
                        'value' => old('name', isset($item) ? $item->name : ''),
                        'placeholder' => 'Введите название компании'
                    ])
                    @include('dashboard.layouts.partials.forms.text', [
                        'title' => 'Домен',
                        'name' => 'slug',
                        'required' => true,
                        'value' => old('slug', isset($item) ? $item->slug : ''),
                        'placeholder' => 'Введите префикс для вашего домена'
                    ])
                    @include('dashboard.layouts.partials.forms.number', [
                        'title' => 'Максимальное кол-во сайтов',
                        'name' => 'site_max',
                        'required' => true,
                        'value' => old('site_max', isset($item) ? $item->site_max : ''),
                        'placeholder' => 'Введите кол-во сайтов'
                    ])
                    @include('dashboard.layouts.partials.forms.checkbox', [
                        'title' => 'Активна',
                        'name' => 'active',
                        'checked' => old('active', isset($item) ? $item->active : false),
                        'color' => 'complete'
                    ])

                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Сохранить" />
                @endcomponent
            @endcomponent
        </div>

        @if(isset($item))
            <div class="col-md-12">
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Пользователи с доступом к управлению
                    @endslot

                    @slot('cardHeader')
                        @include('dashboard.layouts.partials.create-new-button', [
                            'link' => route('dashboard.partner.vendors.users.create', $item->id)
                        ])
                    @endslot

                    @if(count($users) > 0)
                        <table class="table table-hover table-condensed no-footer" role="grid">
                            <thead>
                            <tr>
                                <th style="width: 20%;" rowspan="1" colspan="1">Создан</th>
                                <th style="width: 20%;" rowspan="1" colspan="1">Статус</th>
                                <th style="width: 20%" rowspan="1" colspan="1">Имя</th>
                                <th style="width: 20%;" rowspan="1" colspan="1">E-mail</th>
                                <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><span class="label">{{ $user->created_at->format('d-m-Y') }}</span></td>
                                    <td>
                                        @if($user->approved === true)
                                            <span class="label label-success">Подтверждён</span>
                                        @else
                                            <span class="label label-danger">Не подтверждён</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @include('dashboard.layouts.partials.button-list-delete-big', [
                                            'link' => route('dashboard.partner.vendors.users.delete', ['id' => $item->id, 'uid' => $user->id])
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <span class="hint-text m-l-5">Пока нет пользователей.</span>
                    @endif
                @endcomponent
            </div>

            @if(isset($sites))
                <div class="col-md-12">
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Сайты компании
                        @endslot

                        @slot('cardHeader')
                            @include('dashboard.layouts.partials.create-new-button', [
                                'link' => route('dashboard.partner.vendors.sites.create', $item->id)
                            ])
                        @endslot

                        @if(count($sites) > 0)
                            <table class="table table-hover table-condensed no-footer" role="grid">
                                <thead>
                                <tr>
                                    <th style="width: 20%" rowspan="1" colspan="1">Создан</th>
                                    <th style="width: 20%" rowspan="1" colspan="1">Статус виджета</th>
                                    <th style="width: 20%;" rowspan="1" colspan="1">Название</th>
                                    <th style="width: 20%;" rowspan="1" colspan="1">Домен</th>
                                    <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sites as $site)
                                    <td><span class="label">{{ $site->created_at->format('d-m-Y') }}</span></td>
                                    <td>
                                        @if($site->widget->enabled === true)
                                            <span class="label label-success">Активнен</span>
                                        @else
                                            <span class="label label-danger">Не активнен</span>
                                        @endif
                                    </td>
                                    <td>{{ $site->name }}</td>
                                    <td>
                                        <span class="label">{{ implode(',', $site->urls) }}</span>
                                    </td>
                                    <td>
                                        @include('dashboard.layouts.partials.button-list-delete-big', [
                                            'name'  => 'Удалить',
                                            'link' => route('dashboard.partner.vendors.sites.delete', ['id' => $item->id, 'siteId' => $site->id])
                                        ])
                                        @include('dashboard.layouts.partials.button-list-edit-big', [
                                            'name'  => 'Запросы',
                                            'link' => route('dashboard.partner.vendors.sites.requests', ['id' => $item->id, 'siteId' => $site->id])
                                        ])
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="hint-text m-l-5">Пока нет сайтов.</span>
                        @endif
                    @endcomponent
                </div>
            @endif

            @if(isset($subscriptions))
                <div class="col-md-12">
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Подписка компании
                        @endslot

                        @if(count($subscriptions) > 0)
                            <table class="table table-hover table-condensed no-footer" role="grid">
                                <thead>
                                <tr>
                                    <th style="width: 25%;" rowspan="1" colspan="1">Пробный период</th>
                                    <th style="width: 25%;" rowspan="1" colspan="1">Статус</th>
                                    <th style="width: 25%" rowspan="1" colspan="1">Стоимость (в месяц)</th>
                                    <th style="width: 25%;" rowspan="1" colspan="1">Следующая оплата</th>
                                    <!-- <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subscriptions as $subscription)
                                    <td>
                                        @if($subscription->trial === true)
                                            <span class="label">До {{ $subscription->finish_at->format('d-m-Y') }}</span>
                                        @else
                                            <span class="label label-success">Окончен</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscription->active === true)
                                            <span class="label label-success">Активная</span>
                                        @else
                                            <span class="label label-danger">Не активная</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $subscription->price }} {!! config('currency.default.icon') !!}
                                    </td>
                                    <td>
                                    <span class="label">
                                            {{ $subscription->finish_at->format('d-m-Y') }}
                                        </span>
                                    </td>
                                    {{--<td>
                                        @include('dashboard.layouts.partials.button-list-delete-big', [
                                            'name'  => 'Остановить',
                                            'link' => route('dashboard.partner.vendors.sites.delete', ['id' => $item->id, 'sid' => $subscription->id])
                                        ])
                                        @include('dashboard.layouts.partials.button-list-edit-big', [
                                            'name'  => 'Продлить',
                                            'link' => route('dashboard.partner.vendors.sites.delete', ['id' => $item->id, 'sid' => $subscription->id])
                                        ])
                                    </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="hint-text m-l-5">Пока нет пользователей.</span>
                        @endif
                    @endcomponent
                </div>
            @endif

            @if(isset($transactions))
                <div class="col-md-12">
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Транизакции
                        @endslot

                        @php /** @var \App\Models\Request[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $transactions */ @endphp

                        @if(count($transactions) > 0)
                            <table class="table table-condensed no-footer" role="grid">
                                <thead>
                                <tr role="row">
                                    <th style="width: 15%" rowspan="1" colspan="1">Статус</th>
                                    <th style="width: 17%" rowspan="1" colspan="1">Дата платежа</th>
                                    <th style="width: 17%" rowspan="1" colspan="1">Номер карты</th>
                                    <th style="width: 15%" rowspan="1" colspan="1">Тип карты</th>
                                    <th style="width: 14%" rowspan="1" colspan="1">Сумма</th>
                                    <th style="width: 24%" rowspan="1" colspan="1">Информация</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $item)
                                    <tr role="row">
                                        <td>
                                            @if($item->is_successful === true)
                                                <span class="label label-success">Успешно</span>
                                            @else
                                                <span class="label label-success">Неуспешно</span>
                                            @endif
                                        </td>
                                        <td><span class="label">{{ $item->created_at->format('d-m-y H:i:s') }}</span></td>
                                        <td>{{ $item->card_last_digits }}</td>
                                        <td>{{ $item->card_type }}</td>
                                        <td>{{ $item->amount }} {!! config('currency.default.icon') !!}</td>
                                        <td>{{ $item->message }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="hint-text m-l-5">Пока нет транзакций</span>
                        @endif
                    @endcomponent
                </div>
            @endif
        @else
            <div class="col-md-5">
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Выберите тариф для компании
                    @endslot
                @endcomponent
            </div>
        @endif
    </div>

@endsection