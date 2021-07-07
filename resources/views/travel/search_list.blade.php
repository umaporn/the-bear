<div class="row">
    @forelse($contentList as $list )
        <div class="col-12 col-sm-4 pb-3">
            @if( isset( $list->new_main_image ) )
                <a href="{{ route('travel.detail', ['id' => $list->id, 'slug' => str_replace(' ', '-', $list->title ) ]) }}">
                    <div class="img-thumb">
                        <img src="data:image/png;base64,{{ $list->new_main_image }}"
                             alt="{{ $list->title }}" title="{{ $list->title }}" class="cover">
                    </div>
                </a>
            @else
                <a href="{{ route('travel.detail', [ 'id' => $list->id, 'slug' => str_replace(' ', '-', $list->title ) ]) }}">
                     <div class="img-thumb">
                                    <img src="https://dummyimage.com/400x400/641212/fff" class="cover">
                                    </div>
                </a>
            @endif
            <div class="description-box">
                <a href="{{ route('travel.detail', [ 'id' => $list->id, 'slug' => str_replace(' ', '-', $list->title ) ]) }}" class="detail-link">
                    {{ $list->title }}
                </a>
            </div>
        </div>
    @empty
        <div class="col pb-3"> <p>No Content</p> </div>
    @endforelse
</div>
    @if($contentList->nextPageUrl())
            <div class="p-3" id="loadMore" data-url="{{ $contentList->nextPageUrl() . '&search=' . $search }}">
                <button type="submit"
                        class="btn btn-secondary btn-lg btn-block button-green">
                    @lang('button.view_more')
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
        <img src="{{ asset('images/loader.gif') }}" class="gif-loader" width="50"
             style="display: block; margin-left: auto; margin-right: auto;">
    @endif
