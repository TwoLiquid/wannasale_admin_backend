@extends('dashboard.layouts.pages.createdit')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список партнеров' => route('dashboard.admin.partners')
    ]])
@stop

@section('title', 'Новый партнер')

@section('fields')
    @include('dashboard.admin.partners.fields')
@stop

@section('back-link')
    {{ route('dashboard.admin.partners') }}
@stop
