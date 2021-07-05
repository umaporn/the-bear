<div class="row mt-3">
    <h5>More From The Bear Travel</h5>
    <div class="more-form-box">
        @foreach($moreContent as $moreItem)
            @if( ( $loop->index % 3  ) === 0   )
                <div class="row align-items-start">
                    @endif
                    <div class="col-md-4 col-xs-6">
                        <div class="card m-1" style="border:none;">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body p-0">
                                        <h6 class="card-title">
                                            <a href="{{ route('travel.detail', [ 'id' => $moreItem->id, 'slug' => str_replace(' ', '-', $moreItem->title) ]) }}" class="detail-link">{{ $moreItem->title }}</a>
                                        </h6>
                                        @if($moreItem['Author'])
                                            <p class="card-text">
                                                <small class="text-muted">{{ $moreItem['Author']->name }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding:0px">
                                    @if($moreItem->new_main_image)
                                        <div class="img-thumb">
                                            <img src="data:image/png;base64,{{ $moreItem->new_main_image }}" class="cover">
                                        </div>
                                    @else
                                        <div class="img-thumb">
                                            <img src="{{ asset('images/100x100.png') }}" class="cover">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if( ( ( $loop->index + 1 ) % 3  ) === 0   )
                </div>
            @endif
        @endforeach
    </div>
</div>