<nav x-data="{ open: false }" class="bg-[#3e2723] border-[#5d4037] dark:bg-[#3e2723] sticky top-0 z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex items-center">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="text-2xl font-serif font-bold text-white text-center">
                    Library Management System
                </span>
            </a>
        </div>
    
        @if (!empty($links))
            <button @click="open = !open" type="button" 
                class="inline-flex items-center p-2 w-9 h-10 justify-center text-sm text-white rounded-lg lg:hidden 
                       hover:text-[#ffccbc] focus:outline-none focus:ring-2 focus:ring-[#8d6e63] dark:text-white
                       dark:hover:text-[#ffccbc] dark:focus:ring-[#8d6e63]" 
                aria-controls="navbar-default" :aria-expanded="open">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>

            <div :class="{ 'hidden': !open, 'block': open }" class=" w-full lg:flex lg:w-auto mt-4 lg:mt-0 text-xl" id="navbar-default">
                <ul class="px-2 font-medium flex flex-col lg:flex-row lg:items-center lg:space-x-4 lg:p-0 lg:mt-0 border-[#5d4037] border-4 rounded-lg 
                           bg-[#3e2723] lg:bg-[#3e2723] lg:border-0 dark:bg-[#3e2723] dark:border-[#5d4037]">
                    @foreach ($links as $href => $label)
                        <x-nav-item href="{{ $href }}">
                            {{ $label }}
                        </x-nav-item>
                    @endforeach
                    <x-nav-item href="#profile">
                        Profile
                    </x-nav-item>
                    <form action="{{route('dashboard')}}" class="mt-3.5 lock text-xl text-white font-medium lg:hover:bg-transparent hover:text-[#ffccbc] focus:outline-none focus:ring-2 hover:bg-[#5d4037] focus:ring-[#8d6e63] rounded-md">
                        <button>
                            <a class="block text-2xl text-white font-medium lg:hover:bg-transparent hover:text-[#ffccbc] focus:outline-none focus:ring-2 hover:bg-[#5d4037] focus:ring-[#8d6e63] px-3 py-2 rounded-md">
                                Logout
                            </a>
                        </button>
                    </form>
                </ul>
            </div>
        @endif
    </div>
</nav>