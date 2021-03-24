@extends('layouts.app')

@section('page-title', __('error.503.page_title'))
@section('page-description', __('error.503.page_description'))

@section('content')
    <section class="content-noslide text-center contact-header" data-aos="fade-down" data-aos-delay="300">
        <h1 class="content-title" data-aos="fade">
            <span>@lang('error.503.page_title') </span>
        </h1>
    </section>
    <section class="container text-center margin-vertical-3">
        @if( $exception->getMessage() )
            <p><strong>@lang('error.503.reason'):</strong> {{ $exception->getMessage() }}</p>
        @endif
        @if( $exception->willBeAvailableAt )
            <p class="alert">@lang('error.503.retry_after', [ 'beginTime' => $exception->willBeAvailableAt ])</p>
        @endif
        <a href="{{ route('home.index') }}">@lang('home.return')</a>
    </section>
@endsection
