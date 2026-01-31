<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request){
        Comment::create([
            'user_id'   => Auth::id(),
            'post_id'   => $request->post_id,
            'comment'   => $request->comment,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->back();
    }
}
