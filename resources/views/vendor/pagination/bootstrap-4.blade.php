@if ($paginator->hasPages())
    <ul class="pagination bg-dark" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled bg-dark text-white" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link bg-dark" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item bg-dark">
                <a class="page-link bg-dark text-white" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled bg-dark" aria-disabled="true"><span class="page-link bg-dark text-white">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active bg-dark" aria-current="page"><span class="page-link bg-dark text-white">{{ $page }}</span></li>
                    @else
                        <li class="page-item bg-dark"><a class="page-link bg-dark text-white" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item bg-dark">
                <a class="page-link bg-dark text-white" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled bg-dark" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link bg-dark" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
