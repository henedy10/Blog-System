<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Foundation\Queue\Queueable;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationForCreatePost implements ShouldQueue, ShouldBeEncrypted
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $recipient,public $userName,public $title)
    {
        //
    }


    /**
     * Determine number of times the job may be attempted.
     */
    public function tries(): int
    {
        return 5;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::make()
            ->title($this->userName.' created a new post')
            ->body($this->title)
            ->success()
            ->sendToDatabase($this->recipient)
            ->broadcast($this->recipient);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Log::info('There is an error :'. $exception);
    }
}
