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
        $posts = User::select('id','title','created_at')->where('id',Auth::id());
        return view('posts.index',compact('posts'));
    }

    public function show($slug){
        $post = Post::select('title','description','created_at')->where('slug',$slug)->first();
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

    public function edit($slug){
        $post = Post::where('slug',$slug)->first();
        return view('posts.edit',compact('post'));
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
