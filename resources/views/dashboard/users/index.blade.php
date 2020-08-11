@extends('dashboard.layouts.default')

@section('title', 'Список пользователей')

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardHeader')
            <!-- <div class="pull-left">
                @include('dashboard.layouts.partials.datatable-search-input')
            </div> -->
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.users.create')
            ])
        @endslot

        @php /** @var \App\Models\User[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $users */ @endphp

        @if(count($users) > 0)
            <table class="table table-hover table-condensed no-footer" role="grid">
                <thead>
                    <tr>
                        <th style="width: 20%" rowspan="1" colspan="1">Имя</th>
                        <th style="width: 20%;" rowspan="1" colspan="1">Email</th>
                        <th style="width: 20%;" rowspan="1" colspan="1">Подтверждён</th>
                        <th style="width: 40%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->approved ? 'Да' : 'Нет' }}</td>
                            <td>
                                @include('dashboard.layouts.partials.button-list-delete-big', [
                                    'link' => route('dashboard.users.delete', $item->id)
                                ])
                                @include('dashboard.layouts.partials.button-list-edit-big', [
                                    'link' => route('dashboard.users.edit', $item->id)
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row padding-20">
                {{ $users->links() }}
            </div>
        @else
            <span class="hint-text m-l-5">Пока нет пользователей</span>
        @endif

    @endcomponent

@stop
