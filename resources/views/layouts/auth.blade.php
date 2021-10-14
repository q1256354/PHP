<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="@yield('description')">
		<meta name="keywords" content="@yield('keywords')">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{__('message.erptitle')}} - @yield('title')</title>
		
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		
		<!-- Styles -->
		<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
		@section('style')
        @show
    </head>
    <body>
        <header>
            @yield('header')
        </header>
		<div class="sidebar">
            @yield('sidebar')
        </div>
		@section('content')
        @show
		<footer>
            @yield('footer')
        </footer>
		
		<!-- Scripts -->
		@section('script')
        @show
    </body>
</html>