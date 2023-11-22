@if (isset($paginator) && $paginator->lastPage() > 1)
<div class="d-flex flex-wrap py-2 mr-3 justify-content-end">
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
        <a href="{{ $paginator->url($paginator->onFirstPage()) }}" class="btn btn-sm btn-icon btn-light-primary mr-2 my-1">
            <i class="ki ki-bold-double-arrow-back icon-xs"></i>
        </a>
        @endif
        <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="btn btn-sm btn-icon btn-light-primary mr-2 my-1">
            <i class="ki ki-bold-arrow-back icon-xs"></i>
        </a>
    @endif
    @for ($i = $from; $i <= $to; $i++)
        @php
            $isCurrentPage = $paginator->currentPage() == $i;
        @endphp
        <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}" class="btn btn-sm btn-icon border-0 btn-hover-primary mr-2 my-1 {{ $isCurrentPage ? 'active' : '' }}">{{ $i }}</a>
    @endfor
    @if ($paginator->currentPage() < $paginator->lastPage())
    <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="btn btn-sm btn-icon btn-light-primary mr-2 my-1">
        <i class="ki ki-bold-arrow-next icon-xs"></i>
    </a>
    @if ($paginator->currentPage() < $paginator->lastPage() - 1)
    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="btn btn-sm btn-icon btn-light-primary mr-2 my-1">
        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
    </a>
    @endif
    @endif
</div>
@endif