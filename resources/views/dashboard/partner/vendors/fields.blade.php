@php /** @var \App\Models\Vendor $item */ @endphp
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
                'checked' => true,
                'color' => 'complete'
            ])
        @endcomponent
    </div>

    @if(isset($item))
        <div class="col-md-5">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Пригласить пользователей в компанию
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.rates.store')])
                    @include('dashboard.layouts.partials.forms.text', [
                        'title' => 'E-mail приглашаемого пользователя',
                        'name' => 'email',
                        'required' => true,
                        'value' => '',
                        'placeholder' => 'Введите E-mail пользователя'
                    ])
                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Пригласить" />
                @endcomponent
            @endcomponent
        </div>

        <div class="col-md-12">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Пользователи с доступом к управлению
                @endslot

                @if(count($users) > 0)
                    <table class="table table-hover table-condensed no-footer" role="grid">
                        <thead>
                        <tr>
                            <th style="width: 25%;" rowspan="1" colspan="1">Статус</th>
                            <th style="width: 30%" rowspan="1" colspan="1">Имя</th>
                            <th style="width: 30%;" rowspan="1" colspan="1">E-mail</th>
                            <th style="width: 15%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
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
                                        'link' => route('dashboard.rates.delete', $user->id)
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
                                <th style="width: 14%;" rowspan="1" colspan="1">Статус</th>
                                <th style="width: 15%;" rowspan="1" colspan="1">Тариф</th>
                                <th style="width: 18%;" rowspan="1" colspan="1">Пробный период</th>
                                <th style="width: 15%" rowspan="1" colspan="1">Начало</th>
                                <th style="width: 18%;" rowspan="1" colspan="1">Следующая оплата</th>
                                <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subscriptions as $subscription)
                                    <td>
                                        @if($subscription->active === true)
                                            <span class="label label-success">Активная</span>
                                        @else
                                            <span class="label label-danger">Не активная</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('dashboard.rates.edit', $subscription->rate->id) }}" target="_blank">{{ $subscription->rate->name }}</a></td>
                                    <td>
                                        @if($subscription->trial === true)
                                            <span class="label">До {{ $subscription->finish_at->format('d-m-Y') }}</span>
                                        @else
                                            <span class="label label-success">Окончен</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="label">
                                            {{ $subscription->started_at->format('d-m-Y') }}
                                        </span>
                                    </td>
                                    <td>
                                    <span class="label">
                                            {{ $subscription->finish_at->format('d-m-Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        @include('dashboard.layouts.partials.button-list-delete-big', [
                                            'name'  => 'Остановить',
                                            'link' => route('dashboard.rates.delete', $subscription->id)
                                        ])
                                        @include('dashboard.layouts.partials.button-list-edit-big', [
                                            'name'  => 'Продлить',
                                            'link' => route('dashboard.rates.delete', $subscription->id)
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
        @endif
    @else
        <div class="col-md-5">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Выберите тариф для компании
                @endslot

                @include('dashboard.layouts.partials.forms.select-simple', [
                    'title' => 'Тарифы',
                    'name' => 'rate_id',
                    'required' => true,
                    'options' => isset($rates) ? $rates->pluck('name', 'id')->toArray() : [],
                    'selected' => 0
                ])
            @endcomponent
        </div>
    @endif
</div>
