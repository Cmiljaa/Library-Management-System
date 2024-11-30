<select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
    class="text-left w-full md:w-48 lg:w-64 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none sm:text-sm">
    <option value="">{{ Str::ucfirst($name) }}</option>
    @foreach ($array as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
