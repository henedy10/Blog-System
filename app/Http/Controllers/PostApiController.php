<?php

namespace App\Http\Controllers;
use App\Models\{Post};
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(){
        $search = request()->query('search');
        $posts  = Post::with('user')
                    ->where('title','LIKE','%' . $search . '%')
                    ->orWhereHas('user',function($q) use($search){
                        $q->where('name','LIKE' ,'%' . $search . '%');
                    })
                    ->paginate(5);

        if( $posts->count() < 1 ){
            return response()->json([
                'message'  => 'There is no posts',
            ],404);
        }else{
            return response()->json([
                'message'      => true,
                'count'        => $posts->count(),
                'data'         => $posts->items(),
                'current_page' => $posts->currentPage(),
            ],200);
        }
    }

    public function show(Post $post){
        return response()->json([
            'message' => true,
            'data'    => $post,
        ],200);
    }


    public function store(Request $request) {
        $validated = $request->validate([
            'title'        => 'required | min:3',
            'description'  => 'required | min:5',
            'user_id'      => 'required | integer | exists:users,id'
        ]);

        $post = Post::create($validated);
        return response()->json([
            'message' => 'post is created successfully',
            'data'    => $post
        ] ,201);
    }

    public function update(Request $request,Post $post){
        $validated = $request->validate([
            'title'        => 'required | min:3',
            'description'  => 'required | min:5',
            'user_id'      => 'required | integer | exists:users,id'
        ]);

        $post->update($validated);

        return response()->json([
            'message'  =>  'post is updated successfully',
            'data'     =>  $post,
        ],200);
    }

    public function destroy(Post $post){
            $post->delete();
            return response()->json([
                'message'       =>  'post is deleted successfully',
                'deleted_id'    =>  $post->id,
            ],200);
    }
}
