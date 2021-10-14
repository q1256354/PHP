@extends('layouts.erp')
@section('description', 'ERP主功能頁面')
@section('keywords', 'ERP')
@section('title', '功能主頁')

@section('style')
	<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
@endsection
@section('header')
@endsection
@section('sidebar')
@endsection

@section('content')
	<div class="container">
    @if (Route::has('login'))
		@auth
			<div class="menu">
				<a href='erp_customer'><div class="btnblock customer">{{ trans('message.customer') }}</div></a>
				<a href='erp_user'><div class="btnblock account">{{ trans('message.account') }}</div></a>
				<a href='erp_device'><div class="btnblock device">{{ trans('message.assets') }}</div></a>
				<a href='erp_shipment'><div class="btnblock shipment">{{ trans('message.ielist') }}</div></a>
				<a href='erp_leave'><div class="btnblock leave">{{ trans('message.leave') }}<label id="message2" class="notify" ></label></div></a>
				<!--a href='erp_work'><div class="btnblock work">{{ trans('message.commute') }}</div></a-->
				<a href='erp_repair'><div class="btnblock repair">{{ trans('message.equip') }}<label id="message"  class="notify"></label></div></a>
				<a href='logout'><div class="btnblock logout">{{ trans('auth.logout') }}</div></a>
			</div>
		@endauth
	@else
		
	@endif
	</div>
@endsection 
@section('script')
@endsection 