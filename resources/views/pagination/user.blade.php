@if ($paginator->hasPages())
    <div class="paginating-container pagination-default">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="javascript:void(0);">Prev</a>
                </li>
            @else
                <li class="prev">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="javascript:void(0);">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="prev disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="javascript:void(0);">Prev</a>
                </li>
            @endif
        </ul>
    </div>
@endif
