<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\{Post};
use Livewire\Component;

class SearchPosts extends Component
{
    use WithPagination;
    public $query = '';

    public function updatedQuery(){
        $this->resetPage();
    }

    public function render(){
        $posts=Post::with('user')
                    ->where('title','LIKE','%' . $this->query . '%')
                    ->orWhereHas('user',function($q){
                        $q->where('name','LIKE' ,'%' . $this->query . '%');
                    })
                    ->simplePaginate(5);

        return view('livewire.search-posts',['posts' => $posts ]);
    }
}
