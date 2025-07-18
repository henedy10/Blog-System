<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(){
        $post=request()->search;
        $unique_post=Post::where('title',$post)->get();
        $postsfromDB=Post::all();

        $allposts=$postsfromDB;

        return view('posts.index',compact('allposts','post','unique_post'));
    }

    public function show(Post $post){

        return view('posts.show',compact('post'));
    }

    public function create() {
        $creators=User::all();
        return view('posts.create',compact('creators'));
    }

    public function store() {
        $title=request()->title;
        $description= request()->description;
        $created_post=request()->post_creator;

        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:5'],
            'post_creator'=>['required','exists:users,id']
        ]);

        $post = new Post;
        $post->title = $title;
        $post->description = $description;
        $post->user_id = $created_post;
        $post->save();

        return redirect()->route('posts.index');
    }

    public function edit(Post $post){
        $creators=User::all();
        return view('posts.edit',compact('post','creators'));
    }

    public function update($PostId){
        $title=request()->title;
        $description= request()->description;
        $created_post=request()->post_creator;
        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:5']
        ]);

        $singlepostfromDB=Post::find($PostId);
        $singlepostfromDB->update([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$created_post,
        ]);

        return redirect()->route('posts.show',$PostId);
    }

    public function destroy($PostId){
        $post=Post::find($PostId);
        $deleted_post=$post->delete();
        return redirect()->route('posts.index')->with('success','تم الحذف بنجاح');
    }
}

