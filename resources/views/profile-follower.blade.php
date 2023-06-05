<x-profilecontent :sharedData="$sharedData">

    <div class="list-group">

        @foreach($followers as $follower)
            <a href="/post/{{$follower->userDoingTheFollow->username}}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="/storage/img/{{$follower->userDoingTheFollow->avatar}}" />
                <strong>{{$follower->userDoingTheFollowing->username}}</strong> on {{$follower->userDoingTheFollowing->created_at->format('d-m-Y')}}
            </a>
        @endforeach
        
    </div>

</x-profilecontent>