<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function showCreateForm(){
        return view('create');
    }

    public function savePost(Request $request){
        $postData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);
        $postData['user_id'] = auth()->user()->id;

        $savePost = Post::create($postData);
        if($savePost){
            return redirect("/post/{$savePost->id}")->with('success', 'Post created successfully');
        }else{
            return back()->with('error', 'Post creation failed');
        }
    }

    public function singlePost(Post $post){
        return view('view-post', ['post' => $post]);
    }

    public function showEditPage(Post $post){
        return view('edit', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request){
        $postData = $request->validate([
            'title' =>'required',
            'content' =>'required',
        ]);

        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);

        $updatePost = $post->update($postData);
        if($updatePost){
            return redirect("/post/{$post->id}")->with('success', 'Post updated successfully');
        }else{
            return back()->with('error', 'Post update failed');
        }
    }

    public function deletePost(Post $post){
        $post->delete();
        return redirect('/')->with('success', 'Post deleted successfully');
    }

    // Api methods

    public function newApiPost(Request $request){
        $postData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $postData['title'] = strip_tags($postData['title']);
        $postData['content'] = strip_tags($postData['content']);
        $postData['user_id'] = auth()->user()->id;

        $savePost = Post::create($postData);
        if($savePost){
            return $savePost->id;
        }
    }

    public function deleteApiPost(Post $post){
        $post->delete();
        return "Post deleted successfully";
    }
}
