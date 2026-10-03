@if ($paginator->hasPages())
<nav>
<ul class="pagination mb-0">

    {{-- Sebelumnya --}}
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link">Sebelumnya</span></li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Sebelumnya</a>
        </li>
    @endif

    {{-- Nomor --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
        @endif
    @endforeach

    {{-- Berikutnya --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Berikutnya</a>
        </li>
    @else
        <li class="page-item disabled"><span class="page-link">Berikutnya</span></li>
    @endif

</ul>
</nav>
@endif