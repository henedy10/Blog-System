<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $allposts=[
            ['id'=>1,'Title'=>'PHP','Posted_By'=>'Hamed','Created_At'=>'2022-10-10'],
            ['id'=>2,'Title'=>'Java','Posted_By'=>'Ahmed','Created_At'=>'2022-10-11'],
            ['id'=>3,'Title'=>'Html','Posted_By'=>'Mhmd','Created_At'=>'2022-10-12']
        ];
        return view('posts.index',['allposts'=>$allposts]);
    }

    public function show($PostId){
        $singlepost=[
            ['id'=>1,'Title'=>'PHP','Posted_By'=>'Hamed','Created_At'=>'2022-10-10'],
            ['id'=>2,'Title'=>'Java','Posted_By'=>'Ahmed','Created_At'=>'2022-10-11'],
            ['id'=>3,'Title'=>'Html','Posted_By'=>'Mhmd','Created_At'=>'2022-10-12']
        ];
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
        return to_route('posts.show');
    }
}

