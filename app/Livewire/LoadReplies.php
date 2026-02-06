<?php

namespace App\Livewire;
use App\Models\Comment;

use Livewire\Component;

class LoadReplies extends Component
{
    public Comment $comment;

    public function mount($comment){
        $this->comment = $comment;
    }

    public function loadReplies()
    {
        $this->comment->loadMissing(['replies.user'])->loadCount('replies');
    }

    public function render()
    {
        return view('livewire.load-replies');
    }
}
