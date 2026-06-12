<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function getNotifications() {
        $notifications = DB::table('notifications')
        ->where('notifiable_id', Auth::user()->id)
        ->whereNull('read_at')
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get()
        ->map(function ($notification) {
            $notification->data = json_decode($notification->data);
            return $notification;
        });

        return response()->json([
            'notifications' => $notifications,
            'unReadNotificationsCount' => $notifications->count()
        ]);
    }

    public function markAsRead(string $notification)
    {
        DB::table('notifications')
        ->where('id', $notification)
        ->where('notifiable_id', Auth::user()->id)
        ->update(['read_at' => now()]);

        return response()->json([
            'success' => true
        ]);
    }

    public function deleteNotification(string $notification)
    {
        DB::table('notifications')
        ->where('id', $notification)
        ->where('notifiable_id', Auth::user()->id)
        ->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function clearAll()
    {
        DB::table('notifications')
        ->where('notifiable_id', Auth::user()->id)
        ->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json([
            'success' => true
        ]);
    }
}
