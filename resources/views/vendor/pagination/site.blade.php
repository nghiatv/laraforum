@if ($paginator->hasPages())
    <ul class="pager">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

        @else
            <li class="previous">
                <a href="{{ $paginator->previousPageUrl() }}">Newer Posts</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            {{--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}

            <li class="next">
                <a href="{{ $paginator->nextPageUrl() }}">Older Posts →</a>
            </li>
        @else

        @endif
    </ul>
@endif
