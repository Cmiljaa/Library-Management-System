@extends('layouts.form')
@section('form')
    @section('heading', 'Edit Profile')
    
    <form class="mt-6 space-y-4" action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col md:flex-row justify-between gap-4">
            <div class="w-full md:w-1/2">
                <x-label for="first_name">First name</x-label>
                <x-input name="first_name" id="first_name" placeholder="John" value="{{ $user->first_name }}" required />
            </div>
    
            <div class="w-full md:w-1/2">
                <x-label for="last_name">Last name</x-label>
                <x-input name="last_name" id="last_name" placeholder="Doe" value="{{ $user->last_name }}" required />
            </div>
        </div>

        <div>
            <x-label for="email">Email Address</x-label>
            <x-input name="email" id="email" type="email" placeholder="johndoe@gmail.com" value="{{ $user->email }}" required />
        </div>

        
        <div>
            <x-label for="phone">Phone</x-label>
            <x-input name="phone" id="phone" type="phone" placeholder="0123456789" value="{{ $user->phone }}" required />
        </div>

        <div>
            <x-button>
                Submit
            </x-button>
        </div>
    </form>
@endsection