@extends('layouts.app')
@section('content')
<div class="container mx-auto mb-16 text-gray-900 rounded-lg text-center sm:text-left">
    <x-table :fields="['setting', 'value', 'type', 'edit']" :pagination="$settings" :action="route('settings.index')">
        @forelse ($settings as $setting)
            <tr class="bg-white hover:bg-gray-100">
                <td class="p-4 border border-gray-400">{{ Str::title(str_replace('_', ' ',  $setting->key)) }}</td>
                <td class="p-4 border border-gray-400">{{ Str::ucfirst($setting->value) }}</td>
                <td class="p-4 border border-gray-400">{{ Str::ucfirst($setting->type) }}</td>
                <td class="p-4 border border-gray-400">
                    <a href="{{ route('settings.edit', $setting) }}">
                        <x-button>
                            Edit
                        </x-button>
                    </a>
                </td>
            </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center p-4 text-black">
                No book loans available at the moment.
            </td>
        </tr>
        @endforelse
    </x-table>
</div>
@endsection