@extends('layouts.form')
@section('form')
    @section('heading')
        Edit Setting {{Str::title(str_replace('_', ' ',  $setting->key))}}
    @endsection

    <form class="space-y-4" action="{{ route('settings.update', $setting) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <x-label for="value">Value</x-label>
            <x-input name="value" value="{{ $setting->value }}" id="value" required />
        </div>
        
        <div>
            <x-button>
                Submit
            </x-button>
        </div>
    </form>
@endsection