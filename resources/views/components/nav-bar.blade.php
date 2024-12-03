<nav x-data="{ open: false }" class="bg-white sticky top-0 z-50 shadow-md border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex items-center">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="text-2xl font-sans font-bold text-gray-800 text-center tracking-wide">
                    Library Management System
                </span>
            </a>
        </div>
    
        @if (!empty($links))
            <button @click="open = !open" type="button" 
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-600 rounded-xl xl:hidden 
                       hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-300" 
                aria-controls="navbar-default" :aria-expanded="open">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div :class="{ 'hidden': !open, 'block': open }" class="w-full xl:flex xl:w-auto mt-4 xl:mt-0 text-base" id="navbar-default">
                <ul class="pb-5 xl:pb-0 px-3 font-medium flex flex-col xl:flex-row xl:items-center xl:space-x-8 bg-gray-50 xl:bg-transparent rounded-xl border xl:border-0 border-gray-300 shadow-sm xl:shadow-none">
                    @foreach ($links as $label => $href)
                        <x-nav-item href="{{ $href }}">
                            {{ $label }}
                        </x-nav-item>
                    @endforeach
                    @auth
                        <x-nav-item href="{{ route('user.show', Auth::user()) }}">
                            Profile
                        </x-nav-item>
                        <form action="{{ route('logout') }}" method="POST" class=" xl:-mt-2 text-xl text-blue-700 font-medium xl:hover:bg-transparent  focus:outline-none focus:ring-2 hover:bg-blue-100 rounded-md">
                            @csrf
                            <button>
                                <a class="block text-2xl text-blue-700 font-medium xl:hover:bg-transparent focus:outline-none focus:ring-2 hover:text-blue-500 px-3 py-2 duration-200">
                                    Logout
                                </a>
                            </button>
                        </form>
                    @endauth
                </ul>
            </div>
        @endif
    </div>
</nav>