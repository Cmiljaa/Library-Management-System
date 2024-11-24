@extends('layouts.app')
@section('content')
<div class="bg-blue-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-700">Sign Up</h2>

        <form class="mt-6 space-y-4" action="/login" method="POST">
            <div class="flex flex-col md:flex-row justify-between gap-4">
                <div class="w-full md:w-1/2">
                    <x-label for="first_name">First name</x-label>
                    <x-input name="first_name" id="first_name" placeholder="John" required />
                </div>
        
                <div class="w-full md:w-1/2">
                    <x-label for="last_name">Last name</x-label>
                    <x-input name="last_name" id="last_name" placeholder="Doe" required />
                </div>
            </div>

            <div>
                <x-label for="email">Email Address</x-label>
                <x-input name="email" id="email" type="email" placeholder="johndoe@gmail.com" required />
            </div>
            
            <div>
                <x-label for="phone">Phone</x-label>
                <x-input name="phone" id="phone" type="phone" placeholder="0123456789" required />
            </div>

            <div>
                <x-label for="password">Password</x-label>
                <x-input name="password" id="password" type="password" required />
            </div>

            <div>
                <x-label for="confirm_password">Confirm Password</x-label>
                <x-input name="confirm_password" id="confirm_password" type="confirm_password" required />
            </div>

            <div>
                <x-button>
                    Sign Up
                </x-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">or continue with</p>
            <a 
                href="/auth/google" 
                class="mt-2 inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm">
                <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
                Sign in with Google
            </a>
        </div>

        <p class="mt-6 text-sm text-center text-gray-600">
            Already have an account? 
            <a href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
</div>