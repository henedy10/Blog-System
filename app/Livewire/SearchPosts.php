<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchPosts extends Component
{
    use WithPagination;
    public $query = '';

    public function updatedQuery(){
        $this->resetPage();
    }

    public function render(){
        $posts = Post::where('user_id',Auth::id())
                    ->where('title','LIKE','%' . $this->query . '%')
                    ->simplePaginate(5);

        return view('livewire.search-posts',['posts' => $posts ]);
    }
}
