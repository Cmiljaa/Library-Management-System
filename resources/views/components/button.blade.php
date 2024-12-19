<button type="submit" 
     {{ $attributes->merge(['class' => 'px-4 py-2 text-white bg-blue-600 border border-transparent rounded-md hover:bg-transparent hover:text-blue-600 hover:border-blue-600 duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-md']) }}>
     {{ $slot }}
</button>