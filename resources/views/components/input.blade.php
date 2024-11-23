<input
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $id }}" 
    value="{{ $value }}" 
    {{ $required ? 'required' : '' }}
    {{ $attributes->has('class') ? $attributes : $attributes->merge(['class' => 'w-full px-4 py-2 mt-2 text-gray-700 bg-gray-50 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent']) }}
>