@extends('layouts.app')

@section('page-title', __('travel.page_title.menu',[
            'menu_title' => '',
        ]))
@section('page-description', __('travel.page_description.menu',[
            'menu_title' => '',
        ]))
@section('page-keyword', __('travel.page_keyword.menu',[
            'menu_title' => '',
        ]))

@section('og-image', asset(config('images.open_graph.default_image')))
@section('og-title', __('travel.og_title.menu',[
            'menu_title' => '',
        ]))
@section('og-description', __('travel.og_description.menu',[
            'menu_title' => '',
        ]))
@section('og-keyword', __('travel.og_keyword.menu',[
            'menu_title' => '',
        ]))
@section('og-url', __('travel.og_url.menu',[
            'menu_id' => '',
            'slug' => ''
        ]) )

@section('content')
    <div class="content-desktop">
    </div>
    <div class="container">
        <div class="container content-detail pt-2" style="margin-top:70px;">
            <h1>{{ $contentList[0]['Menu']->menu_name }}</h1>
            <div id="content-list-box">
                @include('travel.menu_list')

            </div>
        </div>
    </div>
@endsection
