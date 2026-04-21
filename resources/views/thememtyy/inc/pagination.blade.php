<div class="pages top20">
    <div class="page-info">
        @if ($paginator->hasPages())
            @if ($paginator->onFirstPage())
            @else
                <a class="page-link fa ds-fanhui" href="{{ $paginator->previousPageUrl() }}"
                   title="@lang('pagination.previous')"></a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))

                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="page-link ho" href="javascript:" title="{{ $page }}">{{ $page }}</a>
                        @else
                            <a class="page-link" href="{{ $url }}" title="{{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-link fa ds-jiantouyou" href="{{ $paginator->nextPageUrl() }}"
                   title="@lang('pagination.next')"></a>
            @else
            @endif
        @endif


    </div>
</div>
