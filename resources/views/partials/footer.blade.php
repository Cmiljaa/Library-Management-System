<footer class="bg-white text-black font-medium mt-4">
    <div class="container mx-auto py-8 px-4">
        <div class="flex flex-col md:flex-row justify-center space-y-8 md:space-y-0 md:space-x-12">
            <div class="text-center">
                <h5 class="uppercase font-semibold mb-4">Resources</h5>
                <ul class="space-y-2">
                    <li class="hover:text-gray-600">
                        <a href="https://laravel.com" target="_blank">Laravel 11</a>
                    </li>
                    <li class="hover:text-gray-600">
                        <a href="https://tailwindcss.com" target="_blank">Tailwind CSS 3</a>
                    </li>
                </ul>
            </div>

            <div class="text-center">
                <h5 class="uppercase font-semibold mb-4">Legal</h5>
                <ul class="space-y-2">
                    <li class="hover:text-gray-600">
                        <a href="{{ route('legal.privacy_policy') }}">Privacy Policy</a>
                    </li>
                    <li class="hover:text-gray-600">
                        <a href="{{ route('legal.terms_and_conditions') }}">Terms & Conditions</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 my-6"></div>

        <div class="flex flex-col md:flex-row justify-between items-center">
            <span class="text-center">© 2025 All Rights Reserved</span>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="https://github.com/Cmiljaa/Library-Management-System" target="_blank" class="text-black hover:text-gray-600">
                    <i class="fab fa-github fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
</footer>