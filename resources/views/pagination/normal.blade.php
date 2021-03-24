@if( $meta['last_page'] !== 1 )
    <ul class="pagination text-center" aria-label="@lang('pagination.pagination')">

        {{--Previous Page Link--}}
        @if( !$links['prev'] )
            <li class="pagination-previous disabled">
                <span class="show-for-sr">@lang('pagination.page')</span>
            </li>
        @else
            <li class="pagination-previous">
                <a href="{{ url()->current() . '?keyword=' . $keyword . '&page=' . ( $meta['current_page']-1 ) }}"
                   aria-label="@lang('pagination.previous') @lang('pagination.page')"
                >
                    <span class="show-for-sr">@lang('pagination.page')</span>
                </a>
            </li>
        @endif

        {{--Pagination Elements--}}
        @for( $i=1; $i < $meta['last_page']; $i++ )
            {{--"Three Dots" Separator--}}
            @if( $meta['last_page'] === 1)
                <li class="ellipsis" aria-hidden="true"></li>
            @endif
            {{--Array Of Links--}}
            @for( $i=1; $i <= $meta['last_page']; $i++ )
                @if( $i === $meta['current_page'] )
                        <li class="current">
                            <span class="show-for-sr">@lang('pagination.current')</span>{{ $i }}
                        </li>
                    @else
                        <li>
                            <a href="{{ url()->current() . '?keyword=' . $keyword . '&page=' . $i }}" aria-label="Page {{ $i }}">{{ $i }}</a>
                        </li>
                    @endif
            @endfor
        @endfor

        {{--Next Page Link--}}
        @if( $links['next'] )
            <li class="pagination-next">
                <a href="{{ url()->current() . '?keyword=' . $keyword . '&page=' . ( $meta['current_page']+1 ) }}" aria-label="@lang('pagination.next') @lang('pagination.page')">
                    <span class="show-for-sr">@lang('pagination.page')</span>
                </a>
            </li>
        @else
            <li class="pagination-next disabled">
                <span class="show-for-sr">@lang('pagination.page')</span>
            </li>
        @endif

    </ul>
@endif