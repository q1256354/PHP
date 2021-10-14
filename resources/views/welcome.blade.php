@extends('layouts.welcome')
@section('description', 'ERP 首頁')
@section('keywords', 'ERP')
@section('title', '首頁')
@section('style')
	<link rel="stylesheet" href="{{ URL::asset('css/welcome.css') }}">
@endsection
@section('sidebar')
    <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    @else
                        <a href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">           
				{{ trans('message.erptitle') }}
                </div>
			@if (Route::has('login'))
                <div class="links">
					@auth
                        <a href="{{ url('/main') }}">{{ trans('message.home') }}</a>
						<a href="{{ url('/logout') }}">{{ trans('auth.logout') }}</a>
					@else
						<a href="{{ route('login') }}">{{ trans('auth.login') }}</a>
						<a href="{{ route('password.request') }}">{{ trans('auth.fogot') }}</a>
					@endauth
                </div>
			@endif
            </div>
        </div>
@endsection
        