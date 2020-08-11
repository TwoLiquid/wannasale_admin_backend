@extends('dashboard.layouts.pages.createdit')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список компаний' => route('dashboard.admin.vendors')
    ]])
@stop

@section('title', 'Новая компания')

@section('fields')
    @include('dashboard.admin.vendors.fields')
@stop

@section('back-link')
    {{ route('dashboard.admin.vendors') }}
@stop
