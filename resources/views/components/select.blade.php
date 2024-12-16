<select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
    class="text-left w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none sm:text-sm">
    <option value="">{{ Str::ucfirst($name) }}</option>
    @foreach ($array as $value => $label)
        <option value="{{ $value }}" {{ old($name, request($name)) == $value ? 'selected' : '' }} >{{ $label }}</option>
    @endforeach
</select>

@error($name)
    <p class="text-red-600 text-sm">
        {{ $message }}
    </p>
@enderror