@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mt-10 mb-20">
    <h1 class="text-4xl font-semibold mb-6 text-black text-center">Your Notifications</h1>

    <div>
        <ul class="divide-gray-200">
            @forelse ($notifications as $notification)
                <li class="my-3">
                    <x-notification :notification="$notification" />
                </li>
            @empty
                <li class="px-4 py-4 text-center text-3xl text-black">
                    No notifications available.
                </li>
            @endforelse
        </ul>
    </div>

    @if ($notifications->isNotEmpty())
        <h1 class="text-2xl font-semibold my-6 text-black">
            You cannot borrow other books until you pay for every overdue fee
        </h1>
    @endif
</div>

@endsection
