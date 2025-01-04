<div class="container mx-auto max-w-7xl py-10 mb-36">

    @if ($pagination->count() && $sortOptions != [])
        <form action="{{ $action }}">
            <div class="w-full max-w-md md:w-auto mb-5">
                <x-label for="sort">Sort</x-label>
                <x-select name="sort" selected="created_at, asc" id="sort" onchange="this.form.submit()" :array="$sortOptions" />
            </div>
        </form>
    @endif
    
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-8">
        <table class="w-full border-collapse border border-gray-400">
            <thead>
                <tr class="bg-black text-white">
                    @foreach ($fields as $field)
                        <th class="p-4 border border-gray-400">
                            {{ Str::title($field) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
    
    @if ($pagination->count())
        <div class="flex justify-center mt-8">
            {{ $pagination->links('pagination::tailwind') }}
        </div>
    @endif
</div>