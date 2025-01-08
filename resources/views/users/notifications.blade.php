@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-4xl font-semibold mb-6 text-black text-center">Your Notifications</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <ul class="divide-y divide-gray-200">
            @forelse ($notifications as $notification)
                <li class="px-4 py-4 bg-red-50 hover:bg-red-300 transition-all duration-300">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1m0 8h.01M12 9v3m-6.93 4.36a9 9 0 1111.32 0M15 3h-6a2 2 0 00-2 2v2a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2z" />
                            </svg>
                            <div>
                                <strong class="text-lg text-red-600">{{ $notification->data['fee'] }} $</strong>
                                <span class="text-sm text-black block md:inline">Overdue Fee</span>
                            </div>
                        </div>
                        <small class="text-xs text-black mt-2 md:mt-0">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="mt-2 text-sm text-black">
                        <p><strong>Book Title:</strong> {{ $notification->data['book_title'] }}</p>
                        <p><strong>Borrow Date:</strong> {{ Carbon\Carbon::parse($notification->data['borrow_date'])->format('jS F, Y') }}</p>
                    </div>
                </li>
            @empty
                <li class="px-4 py-4 text-center text-3xl text-black">
                    No notifications available.
                </li>
            @endforelse
        </ul>
    </div>

    @if ($notifications->isNotEmpty())
        <h1 class="text-2xl font-semibold mt-6 text-black">
            You cannot borrow other books until you pay for every overdue fee
        </h1>
    @endif
</div>




@endsection
