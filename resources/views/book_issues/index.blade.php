@extends('layouts.app')
@section('content')

<div class="container mx-auto max-w-7xl py-10 mb-36">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-8">
        <table class="w-full border-collapse border border-gray-400">
            <thead>
                <tr class="bg-black text-white">
                    <th class="p-4 border border-gray-400">User</th>
                    <th class="p-4 border border-gray-400">Book</th>
                    <th class="p-4 border border-gray-400">Pickup Date</th>
                    <th class="p-4 border border-gray-400">Return Date</th>
                    <th class="p-4 border border-gray-400">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($book_issues as $book_issue)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="p-4 border border-gray-400">{{ $book_issue->user->last_name }} {{ $book_issue->user->first_name }}</td>
                        <td class="p-4 border border-gray-400">{{ $book_issue->book->title }}</td>
                        <td class="p-4 border border-gray-400">{{ Carbon\Carbon::parse($book_issue->pickup_date)->format('jS F, Y') ?? '' }}</td>
                        <td class="p-4 border border-gray-400">{{ $book_issue->return_date ? Carbon\Carbon::parse($book_issue->return_date)->format('jS F, Y') : ''}}</td>
                        <td class="p-4 border border-gray-400">{{ Str::ucfirst($book_issue->status) }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-black">
                        No book issues available at the moment.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($book_issues->count())
        <div class="flex justify-center mt-8">
            {{ $book_issues->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
