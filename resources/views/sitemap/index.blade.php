@extends('layouts.app')

@section('page-title', __('sitemap.page_title.index'))
@section('page-description', __('sitemap.page_description.index'))

@section('og-image', asset(config('images.open_graph.default_image')))
@section('og-title', __('sitemap.og_title.index'))
@section('og-description', __('sitemap.og_description.index'))
@section('og-url', __('sitemap.og_url.index') )

@section('content')
    <section class="content-noslide text-center contact-header" data-aos="fade-down" data-aos-delay="300">
        <h1 class="content-title" data-aos="fade">
            <span>@lang('sitemap.page_title.index')</span>
        </h1>
    </section>
    <section class="content about-bg3">
    <ul >
        @foreach ( $pages as $page )
            <li class="unstyled"><a href="{{ route( $page['routeName'] ) }}">{{ __( $page[ 'page_link' ] ) }}</a></li>
        @endforeach
    </ul>
    </section>
@endsection

