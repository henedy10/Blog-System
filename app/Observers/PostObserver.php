<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use App\Jobs\NotificationForCreatePost;
use App\Events\notificationForUpdatePostStatus;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $admins = User::where('role','admin')->first();

        NotificationForCreatePost::dispatch($admins,Auth::user()->name,$post->title);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {

        $recipient = User::where('id',$post->user_id)->first();
        if($recipient->id != Auth::user()->id) {
            try {
                    Notification::make()
                        ->title($post->title)
                        ->body(
                            "The post's status has been changed to: {$post->status}.".
                            "The message is: {$post->message}."
                        )
                        ->sendToDatabase($recipient);

                    broadcast(new notificationForUpdatePostStatus($post->user_id,$post->message,$post->status));
            } catch (\Exception $e) {

                Log::error('Failed to send notification: ' . $e->getMessage());
            }
        }
    }
    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
