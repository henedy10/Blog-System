<?php

namespace App\Livewire;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeButton extends Component
{
    public $isLiked;
    public $comment;

    public function mount($comment){
        $this->comment = $comment;
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
        }else{
            $this->isLiked = true;
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
