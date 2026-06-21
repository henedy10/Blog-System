<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class PostReadController extends Controller
{
    public function index(Request $request)
    {
        $posts = Cache::remember('posts', 300, function () {
                return Post::query()
                            ->where('status', 'accepted')
                            ->with('user')
                            ->latest()
                            ->paginate(6)
                            ->withQueryString();
            });

        return view('blog.posts.index', @compact('posts', 'q'));
    }

    public function show(Post $post)
    {
        abort_unless($post->status === 'accepted', 404);

        $post->load([
                    'user',
                    'comments' => function($q){
                        $q->withCount('replies');
                    }
                ])
            ->loadCount(['comments', 'likes']);

        return view('blog.posts.show', compact('post'));
    }
}

