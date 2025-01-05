<?php

namespace App\Services;

use Illuminate\Notifications\DatabaseNotification;

class NotificationService
{
    public function deleteNotification(DatabaseNotification $notification): void
    {
       $notification->delete();
    }
}