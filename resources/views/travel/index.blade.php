@extends('layouts.app')

@section('page-title', __('travel.page_title.index'))
@section('page-description', __('travel.page_description.index'))
@section('page-keyword', __('travel.page_keyword.index'))

@section('og-image', asset(config('images.open_graph.default_image')))
@section('og-title', __('travel.og_title.index'))
@section('og-description', __('travel.og_description.index'))
@section('og-keyword', __('travel.og_keyword.index'))
@section('og-url', __('travel.og_url.index') )

@section('content')

    <div class="content-desktop">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for($i=0; $i < count($webStory); $i++)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" {{ $i===0 ? 'class=active' : ''}}></li>
                @endfor
            </ol>
            <div class="carousel-inner">
                @foreach($webStory as $storyItem)
                    <div class="carousel-item {{ $loop->first ? 'active' : ''}} ">
                        <img class="d-block w-100" src="data:image/png;base64,{{ $storyItem->new_main_image }}" alt="{{ $storyItem->name }}">
                        <div class="carousel-caption float-right">
                            <a href="{{ route('travel.detail', ['id' => $storyItem['content'][0]->id, 'slug' => str_replace(' ', '-', $storyItem['content'][0]->title ) ]) }}" class="detail-link">{{ $storyItem->name }}
                                >> </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div>
        <div class="container content-detail pt-2">
            <h1 class="text-center">Pick your flavor</h1>
            <div class="row">
                <div class="col-12 col-sm-4 pick-flavor" data-url="{{ route('travel.tags', ['slug' => 'explore' ]) }}">
                    <img src="{{ asset('images/explore.svg') }}">
                    <div class="pick-flavor-text">Explore</div>
                </div>
                <div class="col-12 col-sm-4 pick-flavor" data-url="{{ route('travel.tags', ['slug' => 'ride' ]) }}">
                    <img src="{{ asset('images/ride.svg') }}">
                    <div class="pick-flavor-text">Ride</div>
                </div>
                <div class="col-12 col-sm-4 pick-flavor" data-url="{{ route('travel.tags', ['slug' => 'eat' ]) }}">
                    <img src="{{ asset('images/eat.svg') }}">
                    <div class="pick-flavor-text">Eat</div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray">
        <div class="container">
            <div class="container content-detail pt-2">
                <h2>Latest</h2>
                <div class="row">
                    @foreach($contentList as $list )
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
                                    <img src="https://dummyimage.com/400x400/641212/fff" style="width:100%">
                                </a>
                            @endif
                            <div class="description-box">
                                <a href="{{ route('travel.detail', [ 'id' => $list->id, 'slug' => str_replace(' ', '-', $list->title ) ]) }}" class="detail-link">
                                    {{ $list->title }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
