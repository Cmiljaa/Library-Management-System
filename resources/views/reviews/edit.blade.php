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
                    <x-star :interactive="true" :number="$review->rating" />
                </div>

                <div>
                    <x-label for="description">Description</x-label>
                    <x-textarea name="description" id="description">{{ $review->description }}</x-textarea>
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