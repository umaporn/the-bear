@extends('layouts.app')

@section('page-title', __('home.page_title.index'))
@section('page-description', __('home.page_description.index'))
@section('page-keyword', __('home.page_keyword.index'))

@section('og-image', asset(config('images.open_graph.default_image')))
@section('og-title', __('home.og_title.index'))
@section('og-description', __('home.og_description.index'))
@section('og-keyword', __('home.og_keyword.index'))
@section('og-url', __('home.og_url.index') )

@section('content')

@endsection
