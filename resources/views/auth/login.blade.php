@extends('layouts.app')
@section('content')
<div class="bg-blue-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>

        <form class="mt-6 space-y-4" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <x-label for="email">Email Address</x-label>
                <x-input name="email" id="email" type="email" placeholder="johndoe@gmail.com" required />
            </div>
            <div>
                <x-label for="password">Password</x-label>
                <x-input name="password" id="password" type="password" required />
            </div>

            <div class="flex items-center">
                <x-input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                <x-label class="ml-2" for="remember">Remember me</x-label>
            </div>

            <div>
                <x-button>
                    Login
                </x-button>
            </div>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            Don't have an account? 
            <a href="{{ route('auth.register') }}" class="text-blue-600 hover:underline">Sign up</a>
        </p>
    </div>
</div>