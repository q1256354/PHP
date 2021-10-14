@extends('layouts.erp')
@section('description', 'ERP設備維護管理')
@section('keywords', 'ERP')
@section('title', '設備維護管理')
@section('style')
@endsection
@section('header')
	<input type="hidden" name="session_type" id="sort1" value="{{$sort}}">
	<input type="hidden" name="session_type" id="sort2" value="{{$rule}}">
	<form class="form-inline" id="addform" action="import_repair" method="post" enctype="multipart/form-data"> 
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_repair'">匯出CSV</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_repair_excel'">匯出Excel</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='mail_test'">mail_test</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='download_test'">download_test</button>
	</form>
	<form class="form-inline" id="searchform">
		<div class="form-group">
			<label class="control-label">輸入關鍵字：</label>
			<input type="text"  class="form-control" id="search" name="search" placeholder="人名、公司、編號">
			<button type="submit" class="btn btn-default btn-sm" id="btn_search">搜尋</button>
			<a href="erp_repair_add" class="btn btn-primary btn-sm">新增資料</a>
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
							<th><a href="?sort=reason&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="reason">報修原因</th>
							<th><a href="?sort=status&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="status">狀態</th>
							<th><a href="?sort=applicant&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="applicant">申請人</th>
							<th><a href="?sort=remarks&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="remarks">備註</th>
							<th><a href="?sort=created_at&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="created_at">申請時間</th>
							<th><a href="?sort=updated_at&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="updated_at">更新時間</th>
						</tr>										
						@foreach($repairs as $repair)
						<tr>
							<td><a href="edit_repair?i={{ $repair->num}}" class="btn btn-success">編輯</a></td>							
							<td>{{ $repair->num}} </td>
							<td>{{ $repair->item}}</td>
							<td>{{ $repair->reason}}</td>
							<td>{{ $repair->status}}</td>
							<td>{{ $repair->applicant}}</td>
							<td>{{ $repair->remarks}}</td>	
							<td>{{ $repair->created_at}}</td>
							<td>{{ $repair->updated_at}}</td>
						</tr>
						@endforeach												
					</table>
				</div>
				<div>
					{{ $repairs->appends(['sort' => $_GET['sort'],'rule' => $_GET['rule'],'search' => $_GET['search']])->render() }}
				</div>
			</div>
		</div>
	</div>
@endsection