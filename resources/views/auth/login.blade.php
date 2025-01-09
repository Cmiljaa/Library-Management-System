@extends('layouts.form')
@section('form')
    @section('heading', 'Login')

    <form class="mt-6 space-y-4" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <x-label for="email">Email Address</x-label>
            <x-input name="email" id="email" type="email" placeholder="johndoe@gmail.com" required />
        </div>
        <div x-data="{ show: false }">
            <div class="flex justify-between">
                <x-label for="password">Password</x-label>
                <button type="button" @click="show = !show" class="bg-transparent hover:text-blue-600 flex items-center">
                    <span x-show="!show" class="mr-2">Hide</span>
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                    <span x-show="show" class="mr-2">Show</span>
                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
            <x-input type="text" x-bind:type="show ? 'text' : 'password'" name="password" id="password" placeholder="Enter your password" required />
        </div>

        <div class="flex items-center">
            <x-input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
            <x-label class="ml-2" for="remember">Remember me</x-label>
        </div>

        <div>
            <x-button class="w-full">
                Login
            </x-button>
        </div>
    </form>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">or continue with</p>
        <a 
            href="{{ route('auth.google') }}" 
            class="mt-2 inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm">
            <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
            Login with Google
        </a>
    </div>

    <p class="mt-6 text-sm text-center text-gray-600">
        Don't have an account? 
        <a href="{{ route('auth.register') }}" class="text-blue-600 hover:underline">Sign up</a>
    </p>
@endsection