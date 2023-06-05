<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //

    public function createFollow(User $user){
        // You cannot follow yourself
        if($user->id === auth()->user()->id){
            return back()->with("error", "You are not allowed to follow yourself");
        }

        // You cannot follow who you already follow
        $alreadyFollowed = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user_id', '=', $user->id]])->count();

        if($alreadyFollowed){
            return back()->with("error", "You already followed ".$user->username);
        }

        // If not following self, and not following existing

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followed_user_id = $user->id;
        $newFollow->save();
        return back()->with('success', "You are now following ".$user->username);
    }

    public function removeFollow(User $user){
        Follow::where([['user_id', '=', auth()->user()->id], ['followed_user_id', '=', $user->id]])->delete();

        return back()->with("success", "You have un-followed ".$user->username);
    }
}
