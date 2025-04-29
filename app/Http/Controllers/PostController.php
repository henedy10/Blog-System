<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){

        $postsfromDB=Post::all();

        $allposts=$postsfromDB;

        return view('posts.index',['allposts'=>$allposts]);
    }

    public function show($PostId){
        $singlepostfromDB=Post::where('id',$PostId)->get();
        $singlepost=$singlepostfromDB;
        return view('posts.show',['singlepost'=>$singlepost,'PostId'=>$PostId]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $title=request()->title;
        $description= request()->description;
        $created_post=request()->post_creator;
        return to_route('posts.index');
    }

    public function edit($PostId){
        return view('posts.edit',['PostId'=>$PostId]);
    }
    public function update(){
        return to_route('posts.show',1);
    }
    public function destroy(){
        return to_route('posts.index');
    }
}

