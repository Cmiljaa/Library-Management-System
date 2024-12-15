@extends('layouts.app')
@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">@yield('heading')</h2>
        @yield('form')
    </div>
</div>
@endsection