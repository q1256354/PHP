@extends('layouts.auth')
@section('description', 'ERP登入')
@section('keywords', 'ERP')
@section('title', '登入')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('auth.login') }}</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
								<label for="account" class="col-md-4 control-label">{{ trans('auth.account') }}</label>

								<div class="col-md-6">
									<input id="account" type="account" class="form-control" name="account" value="{{ old('account') }}" required autofocus>

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
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('auth.rememberme') }}
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										{{ trans('auth.login') }}
									</button>

									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ trans('auth.fogot') }}
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
