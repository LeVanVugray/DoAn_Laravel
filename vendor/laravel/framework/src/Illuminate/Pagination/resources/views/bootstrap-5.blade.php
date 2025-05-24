@if ($paginator->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination mb-0">
                {{-- Nút trang trước --}}
                <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" 
                       href="{{ $paginator->previousPageUrl() ?? '#' }}" 
                       rel="prev" 
                       aria-label="Trang trước">
                        &laquo;
                    </a>
                </li>

                {{-- Trang đầu --}}
                @if ($paginator->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                    </li>
                    @if ($paginator->currentPage() > 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endif

                {{-- Các số trang gần trang hiện tại --}}
                @for ($i = max(2, $paginator->currentPage() - 2); $i <= min($paginator->lastPage() - 1, $paginator->currentPage() + 2); $i++)
                    <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Trang cuối --}}
                @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                    </li>
                @endif

                {{-- Nút trang kế tiếp --}}
                <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" 
                       href="{{ $paginator->nextPageUrl() ?? '#' }}" 
                       rel="next" 
                       aria-label="Trang sau">
                        &raquo;
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
