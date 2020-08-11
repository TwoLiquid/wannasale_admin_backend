@if(isset($disabled) && $disabled)
    <span data-toggle="tooltip" title="Недоступно" class="fs-13 pull-right text-success m-l-5 hint-text">
        <i class="fa fa-plus fa-fw"></i>
    </span>
@else
    <a href="{{ $link or '#' }}" data-toggle="tooltip" title="{{ $name or 'Добавить' }}" class="fs-13 pull-right text-primary m-l-5 hint-text">
        <i class="fa fa-plus fa-fw"></i>
    </a>
@endif