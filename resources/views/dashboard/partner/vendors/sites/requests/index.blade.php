@extends('dashboard.layouts.default')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список компаний' => route('dashboard.partner.vendors'),
        $vendor->name => route('dashboard.partner.vendors.edit', $vendor->id)
    ]])
@stop

@section('title', $site->name)

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardTitle')
            Основная статистика по запросам клиентов
        @endslot

        {{--@slot('cardHeader')
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.partner.vendors.create')
            ])
        @endslot--}}

        @php /** @var \App\Models\Vendor[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $items */ @endphp
        
        @if(count($items) > 0)
            <table class="table table-hover table-condensed no-footer" role="grid">
                <thead>
                    <tr>
                        <th style="width: 20%" rowspan="1" colspan="1">Создан</th>
                        <th style="width: 35%;" rowspan="1" colspan="1">Товар</th>
                        <th style="width: 20%" rowspan="1" colspan="1">Предложенная цена</th>
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

            {{ $items->links() }}
        @else
            <span class="hint-text m-l-5">Пока нет запросов</span>
        @endif

    @endcomponent

@stop
