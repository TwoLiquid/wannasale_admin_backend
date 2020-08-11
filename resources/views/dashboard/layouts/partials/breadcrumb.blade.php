<ol class="breadcrumb">
    @foreach($links as $name => $link)
        <li class="breadcrumb-item"><a href="{{ $link }}" class="active no-margin">{!! $name !!}</a></li>
        @if($loop->last)
            <li class="breadcrumb-item"></li>
        @endif
    @endforeach
</ol>
