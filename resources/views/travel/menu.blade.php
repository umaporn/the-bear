@extends('layouts.app')
@section('page-title', __('travel.page_title.menu',[
            'menu_title' => isset( $contentList[0]['Menu']->menu_name )? $contentList[0]['Menu']->menu_name : '',
        ]))
@section('page-description', __('travel.page_description.menu',[
            'menu_title' =>  isset( $contentList[0]['Menu']->menu_name )  ? $contentList[0]['Menu']->menu_name : '',
        ]))
@section('page-keyword', __('travel.page_keyword.menu',[
            'menu_title' =>  isset( $contentList[0]['Menu']->menu_name )? $contentList[0]['Menu']->menu_name : '',
        ]))

@section('og-image', asset(config('images.open_graph.default_image')))
@section('og-title', __('travel.og_title.menu',[
            'menu_title' =>  isset( $contentList[0]['Menu']->menu_name ) ? $contentList[0]['Menu']->menu_name : '',
        ]))
@section('og-description', __('travel.og_description.menu',[
            'menu_title' =>  isset( $contentList[0]['Menu']->menu_name )? $contentList[0]['Menu']->menu_name : '',
        ]))
@section('og-keyword', __('travel.og_keyword.menu',[
            'menu_title' =>  isset( $contentList[0]['Menu']->menu_name )? $contentList[0]['Menu']->menu_name : '',
        ]))
@section('og-url', __('travel.og_url.menu',[
            'menu_id' => isset($contentList[0]['Menu']->id )? $contentList[0]['Menu']->id : '',
            'slug' => str_replace(' ', '-', isset( $contentList[0]['Menu']->menu_name ) ? $contentList[0]['Menu']->menu_name : ''),
        ]) )

@section('content')
    <div class="content-desktop">
    </div>
    <div>
        <div class="container content-detail" style="margin-top:70px;">

            @if($contentList->total() !==  0)
                <h1>{{ $contentList[0]['Menu']->menu_name }}</h1>
                <div id="content-list-box">
                    @include('travel.menu_list')

                </div>
            @else
                <h3>Empty Content</h3>
            @endif

        </div>
    </div>
@endsection
