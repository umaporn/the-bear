@extends('layouts.app')

@section('page-title', __('travel.page_title.detail', [
            'travel_title' => $contentDetail['data'][0]->title,
        ]))
@section('page-description', __('travel.page_description.detail', [
            'travel_description' => $contentDetail['data'][0]->description,
        ]))
@section('page-keyword', __('travel.page_keyword.detail',[
            'travel_keyword' => $contentDetail['data'][0]->keyword,
        ]))

@section('og-image', asset(''))
@section('og-title', __('travel.og_title.detail', [
            'travel_title' => $contentDetail['data'][0]->title,
        ] ))
@section('og-description', __('travel.og_description.detail', [
            'travel_description' => $contentDetail['data'][0]->description,
        ] ))
@section('og-keyword', __('travel.og_keyword.detail',[
            'travel_keyword' => $contentDetail['data'][0]->keyword,
        ]))
@section('og-url', __('travel.og_url.detail',[
            'travel_id' => $contentDetail['data'][0]->id,
            'slug' => str_replace(" ", "-", $contentDetail['data'][0]->title)
        ]) )

@section('content')

    <div class="container pt-1">
        <div>
            <img src="data:image/png;base64,{{ $mainImage }}" class="w-100" alt="">
        </div>
        <div class="container content-detail pt-2">
            {{--<div class="lead">
                @if($contentDetail['menuInContent'])
                    @foreach( $contentDetail['menuInContent'] as $menu )
                        {{ $menu['menuName'] }}
                        @if(!$loop->last)
                            |
                        @endif
                    @endforeach
                @endif
            </div>--}}
            <div class="row pt-2">
                <div class="col text-left">BY {{ $contentDetail['data'][0]['Author'] ? $contentDetail['data'][0]['Author']->name : '' }}</div>
            </div>

            <div class="row pt-2">
                <div class="col">
                    <h1>{{ $contentDetail['data'][0]->title }}</h1>
                    {!! $contentDetail['data'][0]->content !!}
                </div>
            </div>
            <div class="row">
                <h4>Gallery</h4>
                <div id="columns">
                    @foreach($galleryImage as $image)
                        <figure>
                            <a href="data:image/png;base64,{{ $image->newImage }}"
                               class="gallery-pic" data-fancybox="gallery-units"
                               data-caption="{{ $image[0]->description }}">
                                <img src="data:image/png;base64,{{ $image->newImage }}"
                                     alt="{{ $image[0]->alt_tag }}" title="{{ $image[0]->alt_tag }}">
                            </a>
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>

        @include('travel.more')

    </div>
@endsection