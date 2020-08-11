@extends('dashboard.layouts.pages.createdit')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список тарифов' => route('dashboard.admin.rates')
    ]])
@stop

@section('title', 'Новый тариф')

@section('fields')
    @include('dashboard.admin.rates.fields')
@stop

@section('back-link')
    {{ route('dashboard.admin.rates') }}
@stop
