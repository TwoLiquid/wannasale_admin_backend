@if(isset($disabled) && $disabled)
    <span title="Недоступно" data-toggle="tooltip" data-animation="false" class="pull-right text-danger m-l-5 hint-text fs-15 hint-text">
        <i class="fa fa-times fa-fw"></i>
    </span>
@else
    <a data-link="{{ $link or '#' }}" title="{!! $title or 'Удалить' !!}" class="pull-right text-danger m-l-5 fs-15 hint-text" href="#" data-toggle="modal" data-animation="false" data-target="#modalConfirm">
        <i title="{!! $title or 'Удалить' !!}" data-toggle="tooltip" class="fa fa-times fa-fw"></i>
    </a>
@endif