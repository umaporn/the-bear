@extends('layouts.app')

@section('page-title', __('group.page_title.index'))
@section('page-description', __('group.page_description.index'))
@section('page-keyword', __('group.page_keyword.index'))

@section('og-image', asset(config('images.open_graph.default_image')))
@section('og-title', __('group.og_title.index'))
@section('og-description', __('group.og_description.index'))
@section('og-keyword', __('group.og_keyword.index'))
@section('og-url', __('group.og_url.index') )

@section('content')

@endsection
