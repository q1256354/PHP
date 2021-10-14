@extends('layouts.erp')
@section('description', '基本資料頁面')
@section('keywords', 'ERP')
@section('title', '基本資料')
@section('style')
@endsection
@section('header')
	
@endsection
@section('sidebar')
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" id="register_form">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-md-4 control-label">姓氏:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}" disabled>			
						</div>	
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">名字:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}" disabled>			
						</div>	
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">暱稱:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="nickname" name="nickname" value="{{$user->nickname}}" disabled>			
						</div>	
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">E-Mail:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="email" name="email" value="{{$user->email}}" disabled>			
						</div>	
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">電話:</label>
						<div class="col-md-6">
							<input type="text"  class="form-control" id="phone" name="phone" value="{{$user->phone}}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">生日:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="birthday" name="birthday" value="{{$user->birthday}}" disabled>			
						</div>
					
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">年齡:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="age" name="age" value="{{$age}}" disabled>			
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">部門:</label>
						<div class="col-md-6">
							<input type="text"  class="form-control" id="department" name="department" value="{{$user->department}}" disabled>			
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">職稱:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="title" name="title" value="{{$user->title}}" disabled>			
						</div>	
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">到職日:</label>		
						<div class="col-md-6">
							<input type="text"  class="form-control" id="start_office_date" name="start_office_date"  value="{{$user->start_office_date}}" disabled>			
						</div>	
					</div>						
				</form>
			</div>
		</div>
	</div>
@endsection