<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;


class Post extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments():HasMany{
        return $this->hasMany(Comment::class)
                    ->whereNull('parent_id')
                    ->with('replies');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    protected static function boot(){
        parent::boot();

        static::saving(function ($post){
            $slug  = Str::slug($post->title);
            $count = post::where('slug','like',"$slug%")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
