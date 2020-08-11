<form id="{{ $formId or '' }}" {{ isset($action) ? 'action=' . $action : '' }} class="with-loading clearfix" method="post" enctype="multipart/form-data">

    {!! csrf_field() !!}

    {!! $slot !!}

    <div class="clearfix"></div>
    <div class="btn-edit-form-group">
        @if(isset($backLink))
            <a href="{{ $backLink }}" class="btn btn-white inline m-b-5">Назад</a>
        @endif
        <input type="submit" class="btn btn-success inline m-b-5" value="{{ $submitText or 'Подтвердить' }}" />
    </div>
</form>
