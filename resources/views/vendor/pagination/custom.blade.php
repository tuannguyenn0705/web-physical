@if ($paginator->total() > 0)
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <div class="inline-flex flex-col items-center">
            {{-- Summary Text --}}
            <p class="text-xs text-gray-600 mb-3">
                Showing
                <span class="font-bold text-gray-900">{{ $paginator->firstItem() ?? 0 }}</span>
                to
                <span class="font-bold text-gray-900">{{ $paginator->lastItem() ?? 0 }}</span>
                of
                <span class="font-bold text-gray-900">{{ $paginator->total() }}</span>
                results
            </p>

            {{-- Page Buttons Row --}}
            <div class="flex items-center justify-center gap-1.5">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="Previous"
                          class="w-8 h-8 rounded-md border border-gray-200/80 bg-white text-gray-300 flex items-center justify-center text-sm select-none cursor-default">
                        &lsaquo;
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous"
                       class="w-8 h-8 rounded-md border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 flex items-center justify-center text-sm transition select-none">
                        &lsaquo;
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true"
                              class="w-8 h-8 rounded-md border border-gray-200 bg-white text-gray-400 flex items-center justify-center text-xs select-none">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                      class="w-8 h-8 rounded-md bg-[#E11D48] border border-[#E11D48] text-white font-bold text-xs flex items-center justify-center shadow-2xs select-none">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" aria-label="Go to page {{ $page }}"
                                   class="w-8 h-8 rounded-md border border-gray-200 bg-white text-gray-700 font-semibold text-xs hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 flex items-center justify-center transition select-none">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"
                       class="w-8 h-8 rounded-md border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 flex items-center justify-center text-sm transition select-none">
                        &rsaquo;
                    </a>
                @else
                    <span aria-disabled="true" aria-label="Next"
                          class="w-8 h-8 rounded-md border border-gray-200/80 bg-white text-gray-300 flex items-center justify-center text-sm select-none cursor-default">
                        &rsaquo;
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
