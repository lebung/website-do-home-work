@if (isset($paginator) && $paginator->lastPage() > 1)
<div class="col-12">
    <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
        <ul class="pagination pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
        @php
            $interval = isset($interval) ? abs(intval($interval)) : 3;
            $from = $paginator->currentPage() - $interval;
            if ($from < 1) {
                $from = 1;
            }
            
            $to = $paginator->currentPage() + $interval;
            if ($to > $paginator->lastPage()) {
                $to = $paginator->lastPage();
            }
        @endphp
        @if ($paginator->currentPage() > 1)
            @if ($paginator->currentPage() > 2)
            <li class="page-item mb-0"><a class="page-link" href="{{ $paginator->url($paginator->onFirstPage()) }}" tabindex="-1"><i class="fas fa-angle-double-left"></i></a></li>
            @endif
            <li class="page-item mb-0"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}" tabindex="-1"><i class="fas fa-angle-left"></i></a></li>
        @endif
        @for ($i = $from; $i <= $to; $i++)
            @php
                $isCurrentPage = $paginator->currentPage() == $i;
            @endphp
            <li class="page-item mb-0 {{ $isCurrentPage ? 'active' : '' }}"><a class="page-link" href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">{{$i}}</a></li>
        @endfor
        @if ($paginator->currentPage() < $paginator->lastPage())
            <li class="page-item mb-0"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" tabindex="-1"><i class="fas fa-angle-right"></i></a></li>
            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
            <li class="page-item mb-0"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" tabindex="-1"><i class="fas fa-angle-double-right"></i></a></li>
            @endif
        @endif
        </ul>
    </nav>
</div>
@endif