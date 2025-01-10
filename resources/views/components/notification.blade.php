<div class="px-4 py-4 bg-red-50 transition-all duration-300 rounded-lg">
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

        <small class="text-xs text-black mt-2 md:mt-0 md:text-sm">{{ $notification->created_at->diffForHumans() }}</small>
    </div>

    <div class="flex flex-col md:flex-row justify-between mt-2 md:mt-4">
        <div class="text-sm text-black">
            <p><strong>Book Title:</strong> {{ $notification->data['book_title'] }}</p>
            <p><strong>Borrow Date:</strong> {{ Carbon\Carbon::parse($notification->data['borrow_date'])->format('jS F, Y') }}</p>
        </div>

        <x-role-access :roles="['admin', 'librarian']">
            <div class="w-full sm:w-auto mt-2 sm:mt-0 flex justify-center sm:justify-start">
                <x-delete :action="route('notifications.destroy', $notification)" name="overdue fee" />
            </div>
        </x-role-access>
    </div>
</div>