@extends('dashboard.layouts.default')

@section('title', 'Список тарифов')

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardHeader')
            <!-- <div class="pull-left">
                @include('dashboard.layouts.partials.datatable-search-input')
                    </div> -->
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.admin.rates.create')
            ])
        @endslot

        @php /** @var \App\Models\User[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $rates */ @endphp

        @if(count($rates) > 0)
            <table class="table table-hover table-condensed no-footer" role="grid">
                <thead>
                <tr>
                    <th style="width: 20%;" rowspan="1" colspan="1">Тип</th>
                    <th style="width: 30%" rowspan="1" colspan="1">Название</th>
                    <th style="width: 20%;" rowspan="1" colspan="1">Цена</th>
                    <th style="width: 30%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rates as $item)
                    <tr>
                        <td>
                            @if($item->default === true)
                                <span class="label label-success">Основной</span>
                            @else
                                <span class="label label-info">Обычный</span>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }} {!! config('currency.default.icon') !!} </td>
                        <td>
                            @include('dashboard.layouts.partials.button-list-delete-big', [
                                'link' => route('dashboard.admin.rates.delete', $item->id)
                            ])
                            @include('dashboard.layouts.partials.button-list-edit-big', [
                                'link' => route('dashboard.admin.rates.edit', $item->id)
                            ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row padding-20">
                {{ $rates->links() }}
            </div>
        @else
            <span class="hint-text m-l-5">Пока нет тарифов.</span>
        @endif

    @endcomponent

@stop
