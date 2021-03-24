<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    @include('google_tag_manager.script')
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('page-description')">

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
    <script type="text/javascript" src="https://unpkg.com/@passbase/button@v3/button.js"></script>

</head>
<body style="background-color: #fafafa;">
@include('google_tag_manager.noscript')

@include('layouts.header')
@include('layouts.content')
@include('layouts.footer')

@include('message_boxes.result')
@include('message_boxes.confirmation')

<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ mix('/js/all.js') }}"></script>

@yield('modal-script')

@if(session()->has('message'))
    <script type="text/javascript">
		//alert('{{ session()->get('message') }}');
		$('#login-error').modal('show');
    </script>
@endif
</body>
</html>
