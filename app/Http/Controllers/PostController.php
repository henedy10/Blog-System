<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\
{
    Post,
    User
};

class PostController extends Controller
{
    public function show(Post $post){
        return view('posts.show',compact('post'));
    }

    public function create() {
        $creators = User::all();
        return view('posts.create',compact('creators'));
    }

    public function store(PostRequest $request) {

        Post::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => $request->post_creator
        ]);

        return redirect()->route('posts.index')->with(['successCreatePost' => 'Post created successfully']);
    }

    public function edit(Post $post){
        $creators = User::all();
        return view('posts.edit',compact('post','creators'));
    }

    public function update($PostId,PostRequest $request){
        $Post  = Post::findOrFail($PostId);
        $Post->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'user_id'      => $request->post_creator,
        ]);

        return redirect()->route('posts.show',$Post->slug)->with(['successUpdatePost' => 'Post is updated successfully']);
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post is deleted successfully');
    }
}

