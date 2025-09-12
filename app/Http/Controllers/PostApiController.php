<?php

namespace App\Http\Controllers;
use App\Models\{Post,User};
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(){
        $post=request() -> search;
        $unique_post=Post::where('title','like','%'.$post.'%')->get();
        $allposts=Post::all();

        if($allposts->count()<1){
            return response() -> json([
                'message'  => 'There is no posts',
            ]);
        }else{
            return response() -> json([
                'message' => true,
                'count'   => $allposts->count(),
                'data'    => $allposts,
            ]);
        }
    }

    public function show(Post $post){
        return response() -> json([
            'message' => true,
            'data'    => $post,
        ]);
    }


    public function store(Request $request) {
        $validated = $request -> validate([
            'title'        => 'required | min:3',
            'description'  => 'required | min:5',
            'user_id'      => 'required | integer | exists:users,id'
        ]);

        $post = Post::create($validated);
        return response() -> json([
            'message' => 'post is created successfully',
            'data'    => $post
        ] ,201);
    }

    public function update(Request $request,Post $post){
        $validated=$request -> validate([
            'title'        => 'required | min:3',
            'description'  => 'required | min:5',
            'user_id'      => 'required | integer | exists:users,id'
        ]);
        $post->update($validated);
        return response() -> json([
            'message'  =>  'post is updated successfully',
            'data'     =>  $post,
        ]);
    }

    public function destroy(Post $post){
        $post->delete();
        return response() -> json([
            'message'       =>  'post is deleted successfully',
            'deleted_data'  =>  $post,
        ]);
    }
}
