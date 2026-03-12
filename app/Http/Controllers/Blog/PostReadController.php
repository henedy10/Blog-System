<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostReadController extends Controller
{
    public function index(Request $request)
    {
        // $q = trim((string) $request->query('q', ''));

        $posts = Post::query()
            ->where('status', 'accepted')
            // ->when($q !== '', fn ($query) => $query->where('title', 'like', '%' . $q . '%'))
            ->with('user')
            ->latest()
            ->paginate(9)
            ->withQueryString();

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

