@if (session('success') || session('error'))
    <div class="fixed top-10 right-0 mr-6 w-full sm:w-1/3 z-50 space-y-4">
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show" 
            x-transition:leave="transition ease-in duration-1000 transform"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="{{ session('success') ? 'bg-green-600' : 'bg-red-600' }} text-white p-4 rounded-lg shadow-lg flex items-center space-x-4 animate__animated animate__fadeInUp">

            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="{{ session('success') ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}">
                </path>
            </svg>

            <div class="flex-1">
                <h4 class="font-sans text-lg font-semibold">
                    {{ session('success') ? 'Successfully!' : 'Error!' }}
                </h4>
                <p class="font-sans text-base">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>

            <button @click="show = false" class="text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9l-5 5m0 0l5 5m-5-5h12" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
@endif