<div x-data="{ open: false }" class="p-6">
        
    <x-button @click="open = true">
        Add Review
    </x-button>

    <div x-show="open" x-transition.opacity class="fixed inset-0 backdrop-blur-md" @click="open = false"></div>
    
    <div x-show="open" x-transition x-cloak class="fixed inset-0 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            
            <button class="text-2xl absolute top-2 right-4 text-gray-500 hover:text-gray-700" @click="open = false">
                &times;
            </button>

            <h2 class="text-xl font-bold mb-4 text-center">Submit a Review</h2>

            <form class="space-y-4" action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div>
                    <x-label for="rating">Rating</x-label>
                    <x-input type="number" name="rating" id="rating" min="1" max="5" required />
                </div>

                <div>
                    <x-label for="description">Description</x-label>
                    <textarea name="description" id="description" 
                        class="w-full px-4 py-2 mt-2 text-gray-700 bg-gray-50 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
                </div>

                <div>
                    <x-button class="w-full">
                        Submit
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>