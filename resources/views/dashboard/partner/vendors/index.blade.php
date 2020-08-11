@extends('dashboard.layouts.default')

@section('title', 'Список компаний')

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardHeader')
            <!-- <div class="pull-left">
                @include('dashboard.layouts.partials.datatable-search-input')
            </div> -->
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.partner.vendors.create')
            ])
        @endslot

        @php /** @var \App\Models\Vendor[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $items */ @endphp
        
        @if(count($items) > 0)
            <table class="table table-hover table-condensed no-footer" role="grid">
                <thead>
                    <tr>
                        <th style="width: 20%;" rowspan="1" colspan="1">Создана</th>
                        <th style="width: 20%;" rowspan="1" colspan="1">Статус</th>
                        <th style="width: 25%" rowspan="1" colspan="1">Название</th>
                        <th style="width: 15%" rowspan="1" colspan="1">Кол-во сайтов</th>
                        <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th>
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
                            <td>
                                @if($item->active === true)
                                    <span class="label label-success">Активна</span>
                                @else
                                    <span class="label label-danger">Неактивна</span>
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ count($item->sites) }} из {{ $item->site_max }}</td>
                            <td>
                                @include('dashboard.layouts.partials.button-list-delete-big', [
                                    'link' => route('dashboard.partner.vendors.delete', $item->id)
                                ])
                                @include('dashboard.layouts.partials.button-list-edit-big', [
                                    'link' => route('dashboard.partner.vendors.edit', $item->id)
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $items->links() }}
        @else
            <span class="hint-text m-l-5">Пока нет компаний</span>
        @endif

    @endcomponent

@stop
