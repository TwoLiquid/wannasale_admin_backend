@php /** @var \App\Models\User $user **/ @endphp
<div class="inline b-a rounded b-grey m-t-8 m-r-5 p-t-2 p-b-4 p-r-6 p-l-6">
    <div class="profile-img-wrapper m-t-5 inline m-r-10">
        <div style="background: url({{ image_url($user->person !== null ? $user->person->photo : null) }}) center; background-size: cover; width: 35px; height: 35px;"></div>
    </div>
    <div class="inline">
        @if($user->person !== null && $user->person->department !== null)
            <div class="small hint-text m-t-6"><strong title="{{ $user->full_name }}" data-toggle="tooltip">{{ str_limit($user->full_name, 30) }}</strong>
                <br /><span title="{{ $user->person->department->name }}" data-toggle="tooltip" data-placement="bottom">{{ str_limit($user->person->department->name, 30) }}</span>
            </div>
        @else
            <div class="small hint-text m-t-15">
                <strong title="{{ $user->full_name }}" data-toggle="tooltip">{{ str_limit($user->full_name, 30) }}</strong>
            </div>
        @endif
    </div>
</div>