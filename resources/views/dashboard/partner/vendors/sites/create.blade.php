@extends('dashboard.layouts.default')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список компаний' => route('dashboard.partner.vendors'),
        $item->name => route('dashboard.partner.vendors.edit', $item->id)
    ]])
@stop

@section('title', 'Добавить новый сайт компании')

@section('content')

    @php /** @var \App\Models\Vendor $item */ @endphp
    <div class="row">

        <div class="col-md-7">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Основные данные
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.partner.vendors.sites.store', $item->id)])
                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Название',
                            'name' => 'name',
                            'required' => true,
                            'value' => old('name', isset($site) ? $site->name : ''),
                            'placeholder' => 'Введите название сайта'
                        ])
                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Домен',
                            'name' => 'url',
                            'required' => true,
                            'value' => old('name', isset($site->urls[0]) ? $site->urls[0] : ''),
                            'placeholder' => 'Введите домен сайта'
                        ])
                    <input type="hidden" name="vendor_id" value="{{ $item->id }}">

                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Пригласить" />
                @endcomponent
            @endcomponent
        </div>
    </div>
@stop