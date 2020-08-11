@extends('dashboard.layouts.default')

@section('title', 'Список запросов')

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardTitle')
            Запросы сайтов всех компаний
        @endslot

        @php /** @var \App\Models\Vendor[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $items */ @endphp
        
        @if(count($items) > 0)
            <table class="table table-hover table-condensed no-footer" role="grid">
                <thead>
                    <tr>
                        <th style="width: 12%" rowspan="1" colspan="1">Создан</th>
                        <th style="width: 15%" rowspan="1" colspan="1">Компания</th>
                        <th style="width: 15%" rowspan="1" colspan="1">Сайт</th>
                        <th style="width: 15%;" rowspan="1" colspan="1">Товар</th>
                        <th style="width: 18%" rowspan="1" colspan="1">Предложенная цена</th>
                        <th style="width: 25%" rowspan="1" colspan="1">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <span class="label">
                                    {{ $item->created_at->format('d-m-Y') }}
                                </span>
                            </td>
                            <td><a href="{{ route('dashboard.partner.vendors.edit', ['id' => $item->vendor->id, 'sid' => $item->site->id]) }}" target="_blank">{{ $item->vendor->name }}</a></td>
                            <td><a href="{{ route('dashboard.partner.vendors.sites.requests', ['id' => $item->vendor->id, 'sid' => $item->site->id]) }}" target="_blank">{{ $item->site->name }}</a></td>
                            <td>{{ $item->item === null ? $item->item_name : $item->item->name }}</td>
                            <td>{{ $item->offered_price }} {!! config('currency.default.icon') !!}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="label label-warning">Новый</span>
                                @elseif($item->status == 1)
                                    <span class="label label-success">В работе (ожидает ответа клиента)</span>
                                @elseif($item->status == 2)
                                    <span class="label label-success">В работе (ожидает ответа оператора)</span>
                                @elseif($item->status == 3)
                                    <span class="label">Закрыт (успешно)</span>
                                @elseif($item->status == 4)
                                    <span class="label label-danger">Закрыт (неуспешно)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <span class="hint-text m-l-5">Пока нет запросов</span>
        @endif

    @endcomponent

@stop
