@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $number)
        <span class="text-yellow-400">★</span>
    @else
        <span class="text-gray-300">☆</span>
    @endif
@endfor