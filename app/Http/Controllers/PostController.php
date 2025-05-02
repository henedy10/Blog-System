<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){

        $postsfromDB=Post::all();

        $allposts=$postsfromDB;

        return view('posts.index',['allposts'=>$allposts]);
    }

    public function show(Post $post){
        // // $singlepostfromDB=Post::where('id',$PostId)->get();
        // // $singlepostfromDB=Post::where('id',$PostId)->first();
        // $singlepostfromDB=Post::findOrfail($PostId);


        // $singlepost=$singlepostfromDB;
        return view('posts.show',['post'=>$post]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $title=request()->title;
        $description= request()->description;
        $created_post=request()->post_creator;

        $post = new Post;
        $post->title = $title;
        $post->description = $description;
        $post->posted_by = $created_post;
        $post->save();

        return to_route('posts.index');
    }

    public function edit(Post $post){
        return view('posts.edit',['post'=>$post]);
    }

    public function update($PostId){
        $title=request()->title;
        $description= request()->description;
        $created_post=request()->post_creator;

        $singlepostfromDB=Post::find($PostId);
        $singlepostfromDB->update([
            'title'=>$title,
            'description'=>$description,
            'posted_by'=>$created_post,
        ]);

        return to_route('posts.show',$PostId);
    }

    public function destroy($PostId){
        $post=Post::find($PostId);
        $deleted_post=$post->delete();

        // $deleted_post=Post::where('id',$PostId)->delete();
        return to_route('posts.index');
    }
}

