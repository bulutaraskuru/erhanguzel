@if ($paginator->hasPages())
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="pagination-area text-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="page-numbers prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class='bx bx-chevron-left'></i>
                </a>
            @else
                <a class="page-numbers prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> <i class='bx bx-chevron-left'></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="page-numbers" aria-disabled="true"><span>{{ $element }}</span></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-numbers current" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-numbers next" aria-label="@lang('pagination.next')"> <i class='bx bx-chevron-right'></i></a>
            @else
                <a class="page-numbers next" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <i class='bx bx-chevron-right'></i>
                </a>
            @endif
        </div>
    </div>
@endif
