<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <link rel="icon" href="{{ asset('tbt-favicon.ico') }}" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('page-description')">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="2 Sep 2030 05:00:00 GMT">
    @include('layouts.opengraph.facebook')

    <title>@yield('page-title')</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken'       => csrf_token(),
            'languageCodes'   => config('app.language_codes'),
            'defaultLanguage' => Utility::getDefaultLanguageCode(),
            'currentLanguage' => App::getLocale(),
        ]) !!};
    </script>
    {!! $gtmHeaderTags[0]->header_code !!}

    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/all.js') }}"></script>
    @yield('autopilot-script')
    <script
            async
            src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.6.1/dist/lazyload.min.js"
    ></script>
    <script>
		window.lazyLoadOptions = {
			elements_selector: '.lazy'
		}
    </script>
</head>
<body>
{!! $gtmBodyTags[0]->body_code !!}

@include('layouts.header')
@include('layouts.content')
@include('layouts.footer')

@include('message_boxes.result')
@include('message_boxes.confirmation')

</body>
</html>
