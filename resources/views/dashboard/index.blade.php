@extends('dashboard.layouts.default')

@section('title', 'Панель управления')

@section('content')

    @component('dashboard.layouts.partials.card')
        You are logged in!
    @endcomponent
@stop
