<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()  {
        $allposts=[
            ['id'=>1,'Title'=>'PHP','Posted_By'=>'Hamed','Created_At'=>'2022-10-10'],
            ['id'=>2,'Title'=>'Java','Posted_By'=>'Ahmed','Created_At'=>'2022-10-11'],
            ['id'=>3,'Title'=>'Html','Posted_By'=>'Mhmd','Created_At'=>'2022-10-12']
        ];
        return view('home',['allposts'=>$allposts]);
    }
}

