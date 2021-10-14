@extends('layouts.erp')
@section('description', 'ERP資產管理列表')
@section('keywords', 'ERP')
@section('title', '資產管理')
@section('style')
@endsection
@section('header')
	<input type="hidden" name="session_type" id="sort1" value="{{$sort}}">
	<input type="hidden" name="session_type" id="sort2" value="{{$rule}}">
	<form class="form-inline" id="addform" action="import_device" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<label class="control-label">請選擇要匯入的CSV檔案：</label>
			<input type="file" class="form-control" name="file">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</div>
		<button type="submit" class="btn btn-danger">匯入CSV</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_device'">匯出CSV</button>
	
	</form>
	<form class="form-inline" id="addform2" action="import_device_excel" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<label class="control-label">請選擇要匯入的Xlsx檔案：</label>
			<input type="file" class="form-control" name="import_file">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</div>	
		<button type="submit" class="btn btn-danger">匯入Excel</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_device_excel'">匯出Excel</button>
	</form>
	<form class="form-inline" id="searchform">
		<div class="form-group">
			<label class="control-label">輸入關鍵字：</label>
			<input type="text"  class="form-control" id="search" name="search" placeholder="人名、公司、編號">
			<button type="submit" class="btn btn-default btn-sm" id="btn_search">搜尋</button>
			<a href="erp_device_add" class="btn btn-primary btn-sm">新增資料</a>
		</div>
	</form>
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
							<th><a href="?sort=num&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="num">編號</th>
							<th><a href="?sort=item&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="item">品項</th>
							<th><a href="?sort=label&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="label">廠牌</th>
							<th><a href="?sort=model&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="model">型號</th>
							<th><a href="?sort=quantity&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="quantity">數量</th>
							<th><a href="?sort=insert_date&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="insert_date">入帳日</th>
							<th><a href="?sort=staff&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="staff">盤點人</th>	
							<th><a href="?sort=purpose&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="purpose">用途</th>	
							<th><a href="?sort=location&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="location">位置</th>	
							<th><a href="?sort=status&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="status">狀況</th>	
							<th><a href="?sort=remarks&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="remarks">備註</th>							
						</tr>										
						@foreach($devices as $device)
						<tr>	
							<td><a href="edit_device?i={{ $device->num}}" class="btn btn-success btn-sm">編輯</a></td>						
							<td>{{ $device->num}} </td>
							<td>{{ $device->item}}</td>
							<td>{{ $device->label}}</td>
							<td>{{ $device->model}}</td>
							<td>{{ $device->quantity}}</td>
							<td>{{ $device->insert_date}}</td>	
							<td>{{ $device->staff}}</td>
							<td>{{ $device->purpose}}</td>
							<td>{{ $device->location}}</td>
							<td>{{ $device->status}}</td>
							<td>{{ $device->remarks}}</td>
						</tr>
						@endforeach												
					</table>
				</div>
				<div>
				{{ $devices->appends(['sort' => $_GET['sort'],'rule' => $_GET['rule'],'search' => $_GET['search']])->render() }}
				</div>
			</div>
		</div>
	</div>
@endsection