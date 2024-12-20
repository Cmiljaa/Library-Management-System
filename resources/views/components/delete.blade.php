<div x-data="{ isModalOpen: false }">

    <x-button @click="isModalOpen = true" class="focus:ring-red-600 bg-red-600 hover:text-red-600 hover:border-red-600">
        Delete {{ Str::ucfirst($name) }}
    </x-button>

    <div 
        x-show="isModalOpen" x-transition.opacity
        class="fixed inset-0 backdrop-blur-md flex items-center justify-center px-4 sm:px-6">
        
        <div x-transition class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md sm:max-w-lg md:max-w-xl">
            
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center md:text-left">Are you sure you want to delete this {{ $name }} ?</h2>
            
            <div class="flex justify-end space-x-4 mt-4">

                <x-button @click="isModalOpen = false" >
                    Cancel
                </x-button>
                <form method="POST" action="{{ $action }}" class="inline-block">
                    @method('DELETE')
                    @csrf
                    <x-button class="focus:ring-red-600 bg-red-600 hover:text-red-600 hover:border-red-600">
                        Delete {{ Str::ucfirst($name) }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</div>