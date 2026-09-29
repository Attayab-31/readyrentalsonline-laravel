<div class="row">
    <!-- Showing Results Summary -->
    <div class="col-sm">
        <div class="text-muted">
            Showing 
            <span class="fw-semibold">{{ $paginator->firstItem() ?? 0 }}</span> 
            to 
            <span class="fw-semibold">{{ $paginator->lastItem() ?? 0 }}</span> 
            of 
            <span class="fw-semibold">{{ $paginator->total() }}</span> Results
        </div>
    </div>
    
    <!-- Pagination Links -->
    <div class="col-sm-auto mt-3 mt-sm-0">
        <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">←</span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">←</a>
                </li>
            @endif

            <!-- Page Number Links -->
            @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                <li class="page-item {{ $paginator->currentPage() == $page ? 'active' : '' }}">
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                </li>
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">→</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">→</span>
                </li>
            @endif
        </ul>
    </div>
</div>
