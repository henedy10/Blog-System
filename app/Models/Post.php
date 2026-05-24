<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([PostObserver::class])]
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
            $count = static::where('slug','like',"$slug%")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
