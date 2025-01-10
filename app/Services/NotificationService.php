<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class NotificationService
{
    public function deleteNotification(DatabaseNotification $notification): void
    {
       $notification->delete();
    }

    public function getNotification(string $bookLoanId, User $user)
    {
        return $user->notifications()->whereJsonContains('data->book_loan_id', $bookLoanId)->first();
    }
}