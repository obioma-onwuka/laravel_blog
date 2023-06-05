<x-profilecontent :sharedData="$sharedData">

    <div class="list-group">

        @foreach($followings as $following)
            <a href="/profile/{{$following->userDoingTheFollowing->username}}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="/storage/img/{{$following->userDoingTheFollowing->avatar}}" />
                <strong>{{$following->userDoingTheFollowing->username}}</strong> on {{$following->userDoingTheFollowing->created_at->format('d-m-Y')}}
            </a>
        @endforeach
        
    </div>

</x-profilecontent>