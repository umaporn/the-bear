@extends('layouts.app')

@section('page-title', __('travel.page_title.detail', [
            'travel_title' => isset($contentDetail['data'][0]->title) ? $contentDetail['data'][0]->title : '',
        ]))
@section('page-description', __('travel.page_description.detail', [
            'travel_description' =>isset($contentDetail['data'][0]->description) ? $contentDetail['data'][0]->description : '' ,
        ]))
@section('page-keyword', __('travel.page_keyword.detail',[
            'travel_keyword' => isset($contentDetail['data'][0]->keyword) ? $contentDetail['data'][0]->description : '',
        ]))

@section('og-image', 'data:image/png;base64,'.$mainImage)
@section('og-title', __('travel.og_title.detail', [
            'travel_title' => isset($contentDetail['data'][0]->title) ? $contentDetail['data'][0]->title : '',
        ] ))
@section('og-description', __('travel.og_description.detail', [
            'travel_description' => isset( $contentDetail['data'][0]->description ) ? $contentDetail['data'][0]->description : '',
        ] ))
@section('og-keyword', __('travel.og_keyword.detail',[
            'travel_keyword' => isset( $contentDetail['data'][0]->keyword ) ? $contentDetail['data'][0]->keyword : '',
        ]))
@section('og-url', __('travel.og_url.detail',[
            'travel_id' => isset($contentDetail['data'][0]->id) ? $contentDetail['data'][0]->id : '',
            'slug' => str_replace(" ", "-", isset( $contentDetail['data'][0]->title ) ? $contentDetail['data'][0]->title : '')
        ]) )

@section('og-sitename', __('travel.page_title.index') )

@section('autopilot-script')
    <!-- Autopilot thebeartravel capture code -->
    <script>    window.ap3c = window.ap3c || {};
		var ap3c            = window.ap3c;
		ap3c.cmd            = ap3c.cmd || [];
		ap3c.cmd.push( function(){
			ap3c.init( 'YNweyh6zCBzay-eldGhlYmVhcnRyYXZlbA', 'https://capture-api.autopilotapp.com/' );
			ap3c.track( { v: 0 } );
		} );
		var s, t;
		s      = document.createElement( 'script' );
		s.type = 'text/javascript';
		s.src  = 'https://s.autopilotapp.com/app.js';
		t      = document.getElementsByTagName( 'script' )[0];
		t.parentNode.insertBefore( s, t );</script>
@endsection

@section('content')

    <div class="container pt-1">
        <div>
            <img src="data:image/png;base64,{{ $mainImage }}" class="w-100" alt="">
        </div>
        <div class="container content-detail-660 pt-2" style="margin-top:30px">
            <div class="row pt-2">
                <div class="col text-left">
                    BY {{ $contentDetail['data'][0]['Author'] ? $contentDetail['data'][0]['Author']->name : '' }}</div>
            </div>

            <div class="row pt-2">
                <div class="col">
                    <h1>{{ $contentDetail['data'][0]->title }}</h1>
                    {!! $contentDetail['newContent'] !!}
                </div>
            </div>s
        </div>

        @include('travel.footer')
        @include('travel.more')

    </div>
@endsection