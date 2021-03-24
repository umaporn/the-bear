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

@endsection
