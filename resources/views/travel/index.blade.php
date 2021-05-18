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
        <img src="{{ asset('images/bg-test.jpg') }}">
    </div>
    <div class="container">
        <div class="container content-detail pt-2">
            <h1 class="text-center">Pick your flavor</h1>
            <div class="row">
                <div class="col-12 col-sm-4 pick-flavor">
                    <img src="{{ asset('images/explore.svg') }}">
                    <div class="pick-flavor-text">Explore</div>
                </div>
                <div class="col-12 col-sm-4 pick-flavor">
                    <img src="{{ asset('images/ride.svg') }}">
                    <div class="pick-flavor-text">Ride</div>
                </div>
                <div class="col-12 col-sm-4 pick-flavor">
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
                    <div class="col-6 col-sm-4 pb-3">
                        <img src="https://dummyimage.com/200x200/641212/fff">
                        <div>Title</div>
                    </div>
                    <div class="col-6 col-sm-4 pb-3">
                        <img src="https://dummyimage.com/200x200/641212/fff">
                        <div>Title</div>
                    </div>
                    <div class="col-6 col-sm-4 pb-3">
                        <img src="https://dummyimage.com/200x200/641212/fff">
                        <div>Title</div>
                    </div>
                    <div class="col-6 col-sm-4 pb-3">
                        <img src="https://dummyimage.com/200x200/641212/fff">
                        <div>Title</div>
                    </div>
                    <div class="col-6 col-sm-4 pb-3">
                        <img src="https://dummyimage.com/200x200/641212/fff">
                        <div>Title</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
