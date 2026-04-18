<?php
namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Jobs\NotificationForCreatePost;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(){
        return view('posts.index');
    }

    public function show(Post $post){
        $post->load([
                'comments' => function($q){
                    $q->withCount('replies');
                }
            ])
            ->loadCount(['comments','likes']);
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


        $recipient = User::where('role','admin')->first();

        NotificationForCreatePost::dispatch($recipient,Auth::user()->name);

        return redirect()->route('posts.index')->with(['successCreatePost' => 'Post created successfully']);
    }

    public function edit(Post $post){
        Gate::authorize('view',$post);
        return view('posts.edit',compact('post'));
    }

    public function update(Post $Post,PostRequest $request){

        Gate::authorize('update',$Post);

        $Post->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'user_id'      => $request->post_creator,
        ]);

        return redirect()->route('posts.show',$Post->slug)->with(['successUpdatePost' => 'Post is updated successfully']);
    }

    public function destroy(Post $post){
        Gate::authorize('delete',$post);
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post is deleted successfully');
    }

}
