<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;

class OverdueBookNotification extends Notification
{
    use Queueable;

    public function __construct(public string $bookLoanId, public float $fee, public string $bookTitle, public \Carbon\Carbon $borrow_date)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'book_loan_id' => $this->bookLoanId,
            'fee' => $this->fee,
            'book_title' => $this->bookTitle,
            'borrow_date' => $this->borrow_date
        ];
    }
}
