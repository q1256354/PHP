@extends('layouts.auth')
@section('description', 'ERP註冊')
@section('keywords', 'ERP')
@section('title', '註冊')
@section('style')
	<link rel="stylesheet" href="/css/vue-datepicker-local.css">
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('auth.register') }}</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}
							
							<div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
								<label for="account" class="col-md-4 control-label">{{ trans('auth.account') }}</label>

								<div class="col-md-6">
									<input id="account" type="text" class="form-control" name="account" value="{{ old('account') }}" placeholder="{{ trans('auth.rule') }}" required autofocus>

									@if ($errors->has('account'))
										<span class="help-block">
											<strong>{{ $errors->first('account') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">{{ trans('auth.password') }}</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" placeholder="{{ trans('auth.rule') }}" required>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">{{ trans('auth.confirmpw') }}</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
								<label for="nickname" class="col-md-4 control-label">{{ trans('auth.nickname') }}</label>

								<div class="col-md-6">
									<input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" required autofocus>

									@if ($errors->has('nickname'))
										<span class="help-block">
											<strong>{{ $errors->first('nickname') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
								<label for="last_name" class="col-md-4 control-label">{{ trans('auth.last_name') }}</label>

								<div class="col-md-6">
									<input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

									@if ($errors->has('last_name'))
										<span class="help-block">
											<strong>{{ $errors->first('last_name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
								<label for="first_name" class="col-md-4 control-label">{{ trans('auth.first_name') }}</label>

								<div class="col-md-6">
									<input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

									@if ($errors->has('first_name'))
										<span class="help-block">
											<strong>{{ $errors->first('first_name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
								<label for="phone" class="col-md-4 control-label">{{ trans('auth.phone') }}</label>

								<div class="col-md-6">
									<input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

									@if ($errors->has('phone'))
										<span class="help-block">
											<strong>{{ $errors->first('phone') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
								<label for="birthday" class="col-md-4 control-label">{{ trans('auth.birthday') }}</label>

								<div class="col-md-6">
									<div id="app">
										<vue-datepicker-local v-model="time" id="birthday" type="text"  name="birthday" value="{{ old('birthday') }}" required autofocus></vue-datepicker-local>
									</div>
									@if ($errors->has('birthday'))
										<span class="help-block">
											<strong>{{ $errors->first('birthday') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
								<label for="department" class="col-md-4 control-label">{{ trans('auth.department') }}</label>

								<div class="col-md-6">
									<input id="department" type="text" class="form-control" name="department" value="{{ old('department') }}" required autofocus>

									@if ($errors->has('department'))
										<span class="help-block">
											<strong>{{ $errors->first('department') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
								<label for="title" class="col-md-4 control-label">{{ trans('auth.title') }}</label>

								<div class="col-md-6">
									<input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

									@if ($errors->has('title'))
										<span class="help-block">
											<strong>{{ $errors->first('title') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">{{ trans('auth.email') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										{{ trans('auth.register') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="/js/vue.js"></script>
	<script src="/js/vue-datepicker-local.js"></script>
	<script>
    new Vue({
      el: "#app",
      data: {
        time: new Date()
      }
    })
  </script>
@endsection 
