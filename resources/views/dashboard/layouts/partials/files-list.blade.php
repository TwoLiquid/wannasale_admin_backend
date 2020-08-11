@php /** @var \App\Models\Support\FileConnectable $connectable **/ @endphp
@component('dashboard.layouts.partials.card', ['cardId' => $connectable->getRouteHash()])
    @slot('cardTitle')
        Прикреплённые файлы
    @endslot
    @slot('cardHeader')
        <a href="{{ route('dashboard.files.create', [$connectable->getType(), $connectable->getEntityId()]) }}" class="btn btn-sm btn-rounded btn-complete pull-right m-l-10"><i class="pg-plus"></i> Добавить файл</a>
    @endslot

    @if(count($files) > 0)
        <ul class="list-group m-t-10 m-b-0 {{ isset($sortable) && !is_null($sortable) ? 'sortable' : '' }}" data-entity="{{ $sortable or '' }}" data-action="{{ route('dashboard.service.sort') }}">
            @foreach($files as $file)
                @php /** @var \App\Models\File $file */ @endphp
                <li class="list-group-item" data-item-id="{{ $file->id }}" data-parent-id="{{ $connectable->getEntityId() }}">
                    @if(isset($sortable) && !is_null($sortable))
                        <span class="list-group-handler"><i class="fa fa-bars"></i></span>
                    @endif
                    <span class="light m-r-5" title="{{ $file->name !== null ? $file->name : $file->filename }}" data-toggle="tooltip">{{ $file->name !== null ? str_limit($file->name, 40) : $file->filename }}</span>
                    @include('dashboard.layouts.partials.button-list-delete', [
                        'link' => route('dashboard.files.delete', [$file->id, 'from' => $connectable->getType() . '/' . $connectable->getEntityId()])
                    ])
                    @include('dashboard.layouts.partials.button-list-edit', [
                        'link' => route('dashboard.files.edit', [$file->id, 'from' => $connectable->getType() . '/' . $connectable->getEntityId()])
                    ])
                    <span class="light m-r-5 pull-right hint-text fs-11" title="Размер файла">{{ pretty_file_size($file->size) }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <span class="hint-text m-l-5">Нет файлов</span>
    @endif
@endcomponent
