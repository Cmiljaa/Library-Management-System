<textarea name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" 
    class="w-full px-4 py-2 mt-2 text-gray-700 bg-gray-50 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">{{ $slot }}</textarea>
@error($name)
    <p class="text-red-600 text-sm">
        {{ $message }}
    </p>
@enderror