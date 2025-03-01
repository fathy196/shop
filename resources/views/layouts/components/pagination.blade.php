<style>
    /* Custom Pagination Styles */
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
}

.page-item {
    margin: 0 4px;
}

.page-link {
    padding: 8px 16px;
    text-decoration: none;
    color: #333;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.page-link:hover {
    background-color: #e9ecef;
}

.page-item.active .page-link {
    background-color: #6a11cb;
    color: white;
    border-color: #2575fc;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #f8f9fa;
    border-color: #ddd;
}
</style>

@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <hr class="my-0" />
        <ul class="pagination justify-content-center my-4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif