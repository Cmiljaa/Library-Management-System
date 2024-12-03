@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="inline-flex items-center -space-x-px">
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed">
                        Previous
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-500">
                        Previous
                    </a>
                </li>
            @endif

            <div class="hidden sm:inline-flex">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li>
                            <span class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed">
                                {{ $element }}
                            </span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-500">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-500">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed">
                        Next
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif