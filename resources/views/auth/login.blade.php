@extends('layouts.form')
@section('form')
    @section('heading', 'Login')

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