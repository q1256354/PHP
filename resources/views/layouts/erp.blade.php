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
        <link rel="stylesheet" href="{{ URL::asset('css/erp.css') }}">
		@section('style')
        @show
    </head>
    <body>
        <header>
            @if (Route::has('login'))
                @auth
                    <nav class="navbar navbar-default navbar-fixed-top">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="main">{{ trans('message.home') }}</a>
                            </div>
                      
                          <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="erp_customer">{{ trans('message.customer') }} <span class="sr-only">(current)</span></a></li>
                                    <li><a href='erp_user'>{{ trans('message.account') }}</a></li>
                                    <li><a href='erp_device'>{{ trans('message.assets') }}</a></li>
                                    <li><a href='erp_shipment'>{{ trans('message.ielist') }}</a></li>
                                    <li><a href='erp_leave'>{{ trans('message.leave') }}</a></li>
                                    <!--li><a href='/'>{{ trans('message.commute') }}</a></li-->
                                    <li><a href='erp_repair'>{{ trans('message.equip') }}<span id="notify_repair"  class="notify" style="display:none;"></span></a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href='memberinfo'>{{ trans('message.welcome') }} {{ Auth::user()->nickname }}</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('message.menu') }}<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href='erp_customer'>{{ trans('message.customer') }}</a></li>
                                            <li><a href='/'>{{ trans('message.account') }}</a></li>
                                            <li><a href='erp_device'>{{ trans('message.assets') }}</a></li>
                                            <li><a href='erp_shipment'>{{ trans('message.ielist') }}</a></li>
                                            <li><a href='erp_leave'>{{ trans('message.leave') }}</a></li>
                                            <li><a href='/'>{{ trans('message.commute') }}</a></li>
                                            <li><a href='erp_repair'>{{ trans('message.equip') }}</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="logout">{{ trans('auth.logout') }}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                @endauth
            @else
    
            @endif
            @yield('header')
        </header>
		@section('content')
        @show
		<footer>
            @yield('footer')
        </footer>
		
        <!-- Scripts -->
        <script src="/js/bootstrap.js"></script>
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
        $(document).on("ready", function(){
        $(function(){
		 setInterval(getalarm,1000) 
		});
		function getalarm (){
            $.ajax({
				   type: 'GET',                     
				   url: "/status", 
				   cache: false,  				  
				   success: function(data){  
				  //alert(result);
                  //$('#title').text(result);
                  if(data>0){
                  $('#notify_repair').text(data);
                  $('#notify_repair').show();
                    }
                    else{
                        $('#notify_repair').hide();
                    }			  	
				   },
				    error: function(xhr, status, error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
				   },
			   });
        }
        });
        </script>
		@section('script')
        @show
    </body>
</html>