<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public function homeContent(){
        if(auth()->check()){
            return view('profile');
        }
        return view('index');
    }

    public function register(Request $request){
        $userData = $request->validate([
            'username' => ['required', 'string', 'max:15', 'min:5', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:30', 'confirmed'],
            'password_confirmation' => 'required',
        ]);
        $userData['password'] = bcrypt($userData['password']);

        $saveInfo = User::create($userData);

        if($saveInfo){
            return redirect('/')->with('success', 'Successfully registered');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function login(Request $request){
        $userData = $request->validate([
            'userlogin' => 'required',
            'userpassword' => 'required',
        ]);

        $userData['userlogin'] = strip_tags($userData['userlogin']);
        $userData['userpassword'] = strip_tags($userData['userpassword']);

        if(auth()->attempt([
            'username' => $userData['userlogin'],
            'password' => $userData['userpassword'],
        ])){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login Success');
        }else{
            return back()->with('error', 'Login credentials not found.');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'Logout Success');
    }

    private function getSharedData(User $user){
        $currentlyFollowing = 0;
        if(auth()->check()){
            $currentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user_id', '=', $user->id]])->count();
        }
         view::share('sharedData', ['avatar' => $user->avatar,'currentlyFollowing' => $currentlyFollowing,'username' => $user->username, 'postCount' => $user->posts()->count()]);
    }
    
    public function profile(User $user){
        // return $user->posts()->get();


        // starts here

        $this->getSharedData($user);
        return View('profile-feed', ['posts' => $user->posts()->latest()->get()]);

        // $currentlyFollowing = 0;
        // if(auth()->check()){
        //     $currentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user_id', '=', $user->id]])->count();
        // }
        // return view('profile-feed', ['avatar' => $user->avatar,'currentlyFollowing' => $currentlyFollowing,'username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
    }

    public function profileFollowing(User $user){
        $this->getSharedData($user);
        return view('profile-following', ['followings' => $user->followingTheseUsers()->latest()->get()]);
    }

    public function profileFollowers(User $user){
        $this->getSharedData($user);
        return view('profile-follower', ['followers' => $user->followers()->latest()->get()]);
    }

    public function showUploadPage(){
        return view('profile-upload');
    }

    public function profileUpload(Request $request){
        $request->validate(['user-image' => 'required|image|max:3000']);

        // $request->file('user-image')->store('public/img'); //store image in folder

        $user = auth()->user();
        $img_data = Image::make($request->file('user-image'))->fit(120)->encode('jpg');
        $filename = $user->id .'-' .uniqid() .'.jpg'; //hash image name with unique id

        Storage::put('public/img/'. $filename, $img_data); //define storage location for image
        $oldAvatar = $user->avatar;

        $user->avatar = $filename;
        $user->save();

        if($oldAvatar != '/default.png'){
            Storage::delete(str_replace("/storage/","public/", $oldAvatar));
        }
        return back()->with('success', 'Image saved successfully');
    }

    public function loginApi(Request $request){
        $userData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        if(auth()->attempt($userData)){
            $user = User::where('username', $userData['username'])->first();
            $token =$user->createTOken('ourapptoken')->plainTextToken;
            return $token;
        }
        return "Cannot find user";
    }

    
}
