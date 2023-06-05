<x-layout :sharedData="$sharedData">

    <div class="container py-md-5 container--narrow">
        <h2 class = "text-capitalize">
            <img class="avatar-small" src="/storage/img/{{$sharedData['avatar']}}" /> {{$sharedData['username']}}
            @auth
                @if(!$sharedData['currentlyFollowing'] AND auth()->user()->username != $sharedData['username'])
                    <form class="ml-2 d-inline" action="/create-follow/{{$sharedData['username']}}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-times"></i></button>
                    </form>
                
                @endif
                @if($sharedData['currentlyFollowing'])
                    <form class="ml-2 d-inline" action="/remove-follow/{{$sharedData['username']}}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">Unfollow <i class="fas fa-user-times"></i></button>
                    </form>
                @endif
            @endauth

            @if(auth()->user()->username == $sharedData['username'])
                <a href = "/profile-upload" class="btn btn-dark btn-sm">Upload Avatar <i class="fas fa-user-plus"></i></a>
            @endif
        </h2>
  
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a href="/profile/{{$sharedData['username']}}" class="profile-nav-link nav-item nav-link active">Posts: {{$sharedData['postCount']}}</a>
            <a href="/profile/{{$sharedData['username']}}/followers" class="profile-nav-link nav-item nav-link">Followers: 3</a>
            <a href="/profile/{{$sharedData['username']}}/following" class="profile-nav-link nav-item nav-link">Following: 2</a>
        </div>

        <div class = "profile-slot-content">
            {{$slot}}
        </div>
  
        

        
    </div>

</x-layout>