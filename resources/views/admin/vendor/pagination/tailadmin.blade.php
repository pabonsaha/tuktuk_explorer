@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row justify-between items-center mt-4 space-y-3 sm:space-y-0">
        {{-- Showing Info --}}
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Showing
            <span class="font-medium text-gray-900 dark:text-gray-100">
                {{ $paginator->firstItem() }}
            </span>
            to
            <span class="font-medium text-gray-900 dark:text-gray-100">
                {{ $paginator->lastItem() }}
            </span>
            of
            <span class="font-medium text-gray-900 dark:text-gray-100">
                {{ $paginator->total() }}
            </span>
            results
        </div>

        {{-- Pagination --}}
        <nav class="flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 cursor-not-allowed">
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800">
                    Prev
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                        {{ $element }}
                    </span>
                @endif

                {{-- Page Numbers --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="px-3 py-2 text-sm font-medium text-gray-300 bg-primary border border-primary rounded-md dark:bg-primary dark:border-primary">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800">
                    Next
                </a>
            @else
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 cursor-not-allowed">
                    Next
                </span>
            @endif
        </nav>
    </div>
@endif
