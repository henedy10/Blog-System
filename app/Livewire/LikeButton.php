<?php

namespace App\Livewire;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeButton extends Component
{
    public $isLiked;
    public $comment;
    public $countLikes;

    public function mount($comment){
        $this->comment = $comment;
        $this->countLikes = $this->comment->likes()->count();

        $this->isLiked = Like::where('likeable_type','App\Models\Comment')
                            ->where('likeable_id',$this->comment->id)
                            ->where('user_id',Auth::id())
                            ->exists();
    }
    public function toggleLike(){
        $liked = Like::where('likeable_type','App\Models\Comment')
                            ->where('likeable_id',$this->comment->id)
                            ->where('user_id',Auth::id())
                            ->first();
        if($liked){
            $this->isLiked = false;
            $liked->delete();
            $this->countLikes--;
        }else{
            $this->isLiked = true;
            $this->countLikes++;
            Like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $this->comment->id,
                'likeable_type' => 'App\Models\Comment'
            ]);
        }

    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
