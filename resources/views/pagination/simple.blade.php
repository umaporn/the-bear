@if( $meta['last_page'] !== 1 )
    <ul class="pagination text-center" role="navigation" aria-label="@lang('pagination.pagination')">

        {{-- Previous Page Link --}}
        @if( !$links['prev'] )
            <li class="pagination-previous disabled">
                @lang('pagination.previous') <span class="show-for-sr">@lang('pagination.page')</span>
            </li>
        @else
            <li class="pagination-previous">
                <a href="{{ url()->current() . '?page=' . ( $meta['current_page']-1 ) }}"
                   aria-label="@lang('pagination.previous') @lang('pagination.page')"
                >
                    @lang('pagination.previous') <span class="show-for-sr">@lang('pagination.page')</span>
                </a>
            </li>
        @endif

        {{--Next Page Link--}}
        @if( $links['next'] )
            <li class="pagination-next">
                <a href="{{ url()->current() . '?page=' . ( $meta['current_page']+1 ) }}"
                   aria-label="@lang('pagination.next') @lang('pagination.page')"
                >
                    @lang('pagination.next') <span class="show-for-sr">@lang('pagination.page')</span>
                </a>
            </li>
        @else
            <li class="pagination-next disabled">
                @lang('pagination.next') <span class="show-for-sr">@lang('pagination.page')</span>
            </li>
        @endif

    </ul>
@endif