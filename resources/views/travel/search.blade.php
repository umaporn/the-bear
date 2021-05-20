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
    </div>
    <div class="container">
        <div class="container content-detail pt-2 ">
            <form id="search-form" class="search-box" method="GET" action="{{ route('travel.search') }}">
                {{ csrf_field() }}
                <div class="p-3 row">
                    <div class="col-8">
                        <input type="text" class="form-control" name="search" id="search" placeholder="e.g. city, places, hotel…">
                    </div>
                    <div class="col-4">
                        <button class="button-green pointer" type="submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>
            <h1>Result</h1>
            <div id="content-list-box">
                @include('travel.search_list')
            </div>
        </div>
    </div>
@endsection
