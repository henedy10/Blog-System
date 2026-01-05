<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LakM\Comments\Concerns\Commentable;
use LakM\Comments\Contracts\CommentableContract;
use Illuminate\Support\Str;


class Post extends Model implements CommentableContract
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function boot(){
        parent::boot();

        static::saving(function ($post){
            $slug  = Str::slug($post->title);
            $count = post::where('slug','like',"$slug%")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
    use Commentable;
}
