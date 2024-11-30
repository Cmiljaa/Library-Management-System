@extends('layouts.app')
@section('content')

<x-nav-bar :links="['Home' => 'home', 'My Books' => 'books', 'Notifications' => 'notifications']" />

<div class="container mx-auto p-4 mt-2">
    <div class="flex items-center justify-center mb-4">
        <div class="w-full max-w-md">
            <x-input name="search" id="search" placeholder="Search..." class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" />
        </div>
    </div>
    <div class="flex flex-wrap items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
        <div class="w-full max-w-md md:w-auto">
            <x-select name="genre" :array="config('book.genres')" />
        </div>
        <div class="w-full max-w-md md:w-auto">
            <x-select name="language" :array="config('book.languages')" />
        </div>
        <div class="w-full max-w-md md:w-auto">
            <x-button class="bg-blue-100">
                Submit
            </x-button>
        </div>
    </div>
</div>
