<div x-data="{ open: false }" class="mt-2">
        
    <x-button @click="open = true">
        Edit Review
    </x-button>

    <div x-show="open" x-transition.opacity class="fixed inset-0 backdrop-blur-md" @click="open = false"></div>
    
    <div x-show="open" x-transition x-cloak class="fixed inset-0 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            
            <button class="text-2xl absolute top-2 right-4 text-gray-500 hover:text-gray-700" @click="open = false">
                &times;
            </button>

            <h2 class="text-xl font-bold mb-4 text-center">Edit a Review</h2>

            <form class="space-y-4" action="{{ route('reviews.update', $review) }}" method="POST">
                @csrf
                @method('PUT')

                <x-input type="hidden" name="book_id" value="{{ $book->id }}" />
                
                <div>
                    <x-label for="rating">Rating</x-label>
                    <x-input type="number" name="rating" value="{{ $review->rating }}" id="rating" min="1" max="5" required />
                </div>

                <div>
                    <x-label for="description">Description</x-label>
                    <textarea name="description" id="description" 
                    class="w-full px-4 py-2 mt-2 text-gray-700 bg-gray-50 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">{{ $review->description }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
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