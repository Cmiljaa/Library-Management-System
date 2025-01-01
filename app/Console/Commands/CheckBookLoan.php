<?php

namespace App\Console\Commands;

use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckBookLoan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:book_loan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if a book loan is overdue and take some actions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookLoans = BookLoan::all();

        foreach($bookLoans as $bookLoan)
        {
            if(now() > Carbon::parse($bookLoan->borrow_date)->copy()->addMonth() && $bookLoan->return_date === null &&  $bookLoan->status != 'overdue')
            {
                $bookLoan->status = 'overdue';
                $bookLoan->save();
            }
        }
    }
}
