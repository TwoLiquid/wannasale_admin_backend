@extends('dashboard.layouts.pages.createdit')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список компаний' => route('dashboard.partner.vendors')
    ]])
@stop

@section('title', 'Новая компания')

@section('fields')
    @include('dashboard.partner.vendors.fields')
@stop

@section('back-link')
    {{ route('dashboard.partner.vendors') }}
@stop
