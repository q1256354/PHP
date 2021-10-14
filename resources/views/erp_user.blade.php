@extends('layouts.erp')
@section('description', 'ERP顧客資料列表')
@section('keywords', 'ERP')
@section('title', '顧客資料列表')
@section('style')
@endsection
@section('header')
	<input type="hidden" name="session_type" id="sort1" value="{{$sort}}">
	<input type="hidden" name="session_type" id="sort2" value="{{$rule}}">
@endsection
@section('sidebar')
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover table-condensed">
						<tr>
							<th>動作</th>
							<th><a href="?sort=id&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="id">編號</th>
							<th><a href="?sort=level&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="level">等級</th>
							<th><a href="?sort=nickname&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="nickname">暱稱</th>
							<th><a href="?sort=last_name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="last_name">姓氏</th>
							<th><a href="?sort=first_name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="first_name">名字</th>
							<th><a href="?sort=email&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="email">Email</th>
							<th><a href="?sort=phone&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="phone">電話</th>			
							<th><a href="?sort=birthday&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="birthdat">生日</th>
							<th><a href="?sort=start_office_date&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="start_office_date">到職日</th>
							<th><a href="?sort=department&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="department">部門</th>
							<th><a href="?sort=title&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="title">職稱</th>
						</tr>										
						@foreach($users as $user)
						<tr>
							<td><a href="edit_member?i={{ $user->id}}" class="btn btn-success">編輯</a></td>							
							<td>{{ $user->id}} </td>
							<td>{{ $user->level}}</td>
							<td>{{ $user->nickname}}</td>
							<td>{{ $user->last_name}}</td>
							<td>{{ $user->first_name}}</td>
							<td>{{ $user->email}}</td>
							<td>{{ $user->phone}}</td>
							<td>{{ $user->birthday}}</td>
							<td>{{ $user->start_office_date}}</td>
							<td>{{ $user->department}}</td>
							<td>{{ $user->title}}</td>
						</tr>
						@endforeach												
					</table>
				</div>
				<div>
					{{ $users->appends(['sort' => $_GET['sort'],'rule' => $_GET['rule'],'search' => $_GET['search']])->render() }}
				</div>
			</div>
		</div>
	</div>
@endsection
