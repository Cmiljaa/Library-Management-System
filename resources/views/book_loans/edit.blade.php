@extends('layouts.form')
@section('form')
    @section('heading', 'Edit Book Loan')

    <form class="space-y-4" action="{{ route('book_loans.update', $bookLoan) }}" method="POST">
        @csrf
        @method('PUT')

        <x-input type="hidden" name="user_id" value="{{ $bookLoan->user_id }}" />
        <x-input type="hidden" name="book_id" value="{{ $bookLoan->book_id }}" />

        <div>
            <x-label for="borrow_date">Borrow Date</x-label>
            <x-input type="date" name="borrow_date" id="borrow_date" value="{{ $bookLoan->borrow_date }}"/>
        </div>
        
        <div>
            <x-label for="return_date">Return Date</x-label>
                <x-input type="date" name="return_date" id="return_date" value="{{ $bookLoan->return_date }}"/>
        </div>

        <div>
            <x-button>
                Submit
            </x-button>
        </div>
    </form>
@endsection