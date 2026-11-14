@props(['paginator'])

@if ($paginator && method_exists($paginator, 'hasPages') && $paginator->hasPages())
    @php
        $window = \Illuminate\Pagination\UrlWindow::make($paginator);
        $elements = array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);
    @endphp

    <nav class="pagination" role="navigation" aria-label="التنقل بين الصفحات">
        <div class="pagination__info">
            عرض <strong>{{ $paginator->firstItem() }}</strong> - <strong>{{ $paginator->lastItem() }}</strong> من أصل
            <strong>{{ $paginator->total() }}</strong>
        </div>

        <ul class="pagination__list">

            @if ($paginator->onFirstPage())
                <li class="pagination__item is-disabled" aria-disabled="true">
                    <span class="pagination__link">السابق</span>
                </li>
            @else
                <li class="pagination__item">
                    <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">السابق</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination__item is-dots" aria-disabled="true">
                        <span class="pagination__link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__item is-active" aria-current="page">
                                <span class="pagination__link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination__item">
                                <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="pagination__item">
                    <a class="pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">التالي</a>
                </li>
            @else
                <li class="pagination__item is-disabled" aria-disabled="true">
                    <span class="pagination__link">التالي</span>
                </li>
            @endif
        </ul>
    </nav>
@endif