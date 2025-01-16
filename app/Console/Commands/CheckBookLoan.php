<?php

namespace App\Console\Commands;

use App\Models\BookLoan;
use App\Notifications\OverdueBookNotification;
use App\Services\SettingService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckBookLoan extends Command
{
    protected $signature = 'check:book_loan';

    protected $description = 'Check if a book loan is overdue and take some actions';

    public function __construct(protected readonly SettingService $settingService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $bookLoans = BookLoan::whereNull('return_date')->with(['book:id,title'])->get();

        foreach($bookLoans as $bookLoan)
        {
            $borrowDate = Carbon::parse($bookLoan->borrow_date)->copy()->addDays($this->settingService->getSettingValue('loan_duration'))
            ->timezone(config('app.timezone'));

            if (Carbon::now()->timezone(config('app.timezone')) <= $borrowDate) {
                continue;
            }

            $existingNotification = $bookLoan->user->notifications()
            ->where('data->book_loan_id', $bookLoan->id)
            ->first();
            
            if($bookLoan->status === 'overdue' && $existingNotification)
            {
                $this->updateExistingNotification($existingNotification, $borrowDate);
            }
            else
            {
                $bookLoan->status = 'overdue';
                $bookLoan->save();
                $this->createNotification($bookLoan, $borrowDate);
            }
        }
    }

    private function updateExistingNotification($existingNotification, $borrowDate): void
    {
        $fee = $this->calculateFee($borrowDate); 

        $existingNotification->update([
            'data' => array_merge($existingNotification->data, [
                'fee' => $fee,
            ]),
        ]);
    }

    private function createNotification($bookLoan, $borrowDate): void
    {
        $fee = $this->calculateFee($borrowDate); 
        $bookLoan->user->notify(new OverdueBookNotification($bookLoan->id, $fee, $bookLoan->book->title, Carbon::parse($bookLoan->borrow_date)));
    }

    public function calculateFee($borrowDate)
    {
        return rtrim(rtrim(number_format(round(now()->startOfDay()->diffInDays($borrowDate) * $this->settingService->getSettingValue('overdue_fee') * 2 / 2, 2), 2, '.', ''), '0'), '.');
    }
}
