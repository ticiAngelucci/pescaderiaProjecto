@include('header')
@if ($paginator->hasPages())
<div class="pager">
    @if ($paginator->onFirstPage())
    <button class="disabled"><span>← Atras</span></button>
    @else
    <button><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Atras</a></button>
    @endif
    @foreach ($elements as $element)
    @if (is_string($element))
    <button class="disabled"><span>{{ $element }}</span></button>
    @endif
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <button class="active my-active"><span>{{ $page }}</span></button>
    @else
    <button><a href="{{ $url }}">{{ $page }}</a></button>
    @endif
    @endforeach
    @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <button><a href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente →</a></button>
    @else
    <button class="disabled"><span>Siguiente →</span></button>
    @endif
</div>
@endif
@include('footer')