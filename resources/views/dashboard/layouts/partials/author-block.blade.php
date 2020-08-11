@php /** @var \App\Models\User $user **/ @endphp
<div>
    <div class="profile-img-wrapper m-t-5 inline m-r-10">
        <div style="background: url({{ image_url($user->person !== null ? $user->person->photo : null) }}) center; background-size: cover; width: 35px; height: 35px;"></div>
    </div>
    <div class="inline">
        @if($user->person !== null && $user->person->department !== null)
            <div class="small hint-text m-t-6"><strong>{{ $user->full_name }}</strong>
                <br />{{ $user->person->department->name }}
            </div>
        @else
            <div class="small hint-text m-t-15">
                <strong>{{ $user->full_name }}</strong>
            </div>
        @endif
    </div>
</div>