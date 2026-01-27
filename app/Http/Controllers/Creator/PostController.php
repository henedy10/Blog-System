<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\
{
    Post,
    User
};

class PostController extends Controller
{
    public function index(){
        $posts = Post::select('id','title','created_at')->where('user_id',Auth::id())->cursor();
        return view('posts.index',compact('posts'));
    }

    public function show(Post $post){
        $post->load('comments')
            ->loadCount('comments')
            ->loadCount('likes');
        return view('posts.show',compact('post'));
    }

    public function create() {
        return view('posts.create');
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
        return view('posts.edit',compact('post'));
    }

    public function update(Post $Post,PostRequest $request){
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
