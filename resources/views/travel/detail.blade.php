@extends('layouts.app')

@section('page-title', __('travel.page_title.detail', [
            'travel_title' => '',
        ]))
@section('page-description', __('travel.page_description.detail', [
            'travel_description'  => '',
        ]))
@section('page-keyword', __('travel.page_keyword.detail'))

@section('og-image', asset(''))
@section('og-title', __('travel.og_title.detail', [
            'travel_title' => '',
        ] ))
@section('og-description', __('travel.og_description.detail', [
            'travel_description'  => '',
        ] ))
@section('og-keyword', __('travel.og_keyword.detail'))
@section('og-url', __('travel.og_url.detail',[
            'travel_id' => '',
        ]) )

@section('content')
    <div class="container pt-1">
        <div>
            <img src="{{ asset('images/placeholder.png') }}" alt="" class="w-100">
        </div>
        <div class="container content-detail pt-2">
            <div class="lead"> 2 Wheels | South of Thailand</div>
            <div class="row pt-2">
                <div class="col text-left">BY Grumpy Bear</div>
                <div class="col text-right">BY Grumpy Bear</div>
            </div>

            <div class="row pt-2">
                <div class="col">
                    <h1>Title</h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.
                    </p>
                </div>
            </div>


        </div>

        <div class="row pt-3">
            <h5>More From The Bear Travel</h5>
            <div class="container more-form-box">
                <div class="row align-items-start">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img src="{{ asset('images/200x200.jpg') }}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        One of three columns
                    </div>
                    <div class="col">
                        One of three columns
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        One of three columns
                    </div>
                    <div class="col">
                        One of three columns
                    </div>
                    <div class="col">
                        One of three columns
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection