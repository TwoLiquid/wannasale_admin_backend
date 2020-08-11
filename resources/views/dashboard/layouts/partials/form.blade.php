<form id="{{ $id or '' }}" {{ isset($action) ? 'action=' . $action : '' }} class="with-loading clearfix" method="{{ $method or 'post' }}" enctype="{{ isset($method) === false || mb_strtolower($method) === 'post' ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}">

    @if (isset($method) === false || mb_strtolower($method) === 'post')
        {!! csrf_field() !!}
    @endif

    {!! $slot !!}
</form>
