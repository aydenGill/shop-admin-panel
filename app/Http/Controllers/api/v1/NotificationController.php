<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationCollection;
use App\Traits\BaseApiResponse;

class NotificationController extends Controller
{
    use BaseApiResponse;

    public function index()
    {
        return $this->success(new NotificationCollection(auth()->user()->notifications), 'Notifications', 'Notifications fetched successfully');
    }

    public function unread()
    {
        $unread = auth()->user()->unreadNotifications;
        $unread->each(function ($notification) {
            $notification->markAsRead();
        });

        return $this->success(new NotificationCollection($unread), 'Notifications', 'Unread notifications fetched successfully');
    }
}
