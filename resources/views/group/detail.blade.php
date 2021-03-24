@extends('layouts.app')


@section('page-title', __('group.page_title.single', [
            'group_title' => '',
        ]))
@section('page-description', __('group.page_description.single', [
            'group_description'  => '',
        ]))
@section('page-keyword', __('group.page_keyword.single'))

@section('og-image', asset(''))
@section('og-title', __('group.og_title.single', [
            'group_title' => '',
        ] ))
@section('og-description', __('group.og_description.single', [
            'group_description'  => '',
        ] ))
@section('og-keyword', __('group.og_keyword.single'))
@section('og-url', __('group.og_url.single',[
            'group_id' => '',
        ]) )

@section('content')

@endsection