@if ($interactive)
    <div x-data="{ rating: {{ $number }} || 1, hoverRating: 0 }" class="flex flex-col items-center space-y-4">
        <div class="flex space-x-1 text-3xl">
            @for ($i = 1; $i <= 5; $i++)
                <span 
                    @click="rating = {{ $i }}" 
                    @mouseover="hoverRating = {{ $i }}" 
                    @mouseleave="hoverRating = 0"
                    :class="{'text-yellow-400': {{ $i }} <= (hoverRating || rating), 'text-gray-300': {{ $i }} > (hoverRating || rating)}"
                    class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
                        <path :class="{'text-yellow-400': {{ $i }} <= (hoverRating || rating), 'text-gray-300': {{ $i }} > (hoverRating || rating)}" d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.785 1.4 8.168L12 18.896l-7.334 3.867 1.4-8.168-5.934-5.785 8.2-1.192z"/>
                    </svg>
                </span>
            @endfor
        </div>
        <x-input type="hidden" name="rating" x-model="rating" min="1" max="5" required />
    </div>
@else
    <div class="-space-x-1">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $number)
                <span class="text-yellow-400">★</span>
            @else
                <span class="text-gray-300">☆</span>
            @endif
        @endfor
    </div>
@endif