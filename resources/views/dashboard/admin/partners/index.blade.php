@extends('dashboard.layouts.default')

@section('title', 'Список партнеров')

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardHeader')
            <!-- <div class="pull-left">
                @include('dashboard.layouts.partials.datatable-search-input')
                    </div> -->
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.admin.partners.create')
            ])
        @endslot

        @php /** @var \App\Models\User[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $partners */ @endphp

        @if(count($partners) > 0)
            <table class="table table-hover table-condensed no-footer" role="grid">
                <thead>
                <tr>
                    <th style="width: 20%" rowspan="1" colspan="1">Создан</th>
                    <th style="width: 20%;" rowspan="1" colspan="1">Статус</th>
                    <th style="width: 20%" rowspan="1" colspan="1">Имя</th>
                    <th style="width: 20%;" rowspan="1" colspan="1">Email</th>
                    <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($partners as $item)
                    <tr>
                        <td><span class="label">{{ $item->created_at->format('d-m-Y') }}</span></td>
                        <td>
                            @if($item->active === true)
                                <span class="label label-success">Подтверждён</span>
                            @else
                                <span class="label label-danger">Не подтверждён</span>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @include('dashboard.layouts.partials.button-list-delete-big', [
                                'link' => route('dashboard.admin.partners.delete', $item->id)
                            ])
                            @include('dashboard.layouts.partials.button-list-edit-big', [
                                'link' => route('dashboard.admin.partners.edit', $item->id)
                            ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row padding-20">
                {{ $partners->links() }}
            </div>
        @else
            <span class="hint-text m-l-5">Пока нет партнеров</span>
        @endif

    @endcomponent

@stop
