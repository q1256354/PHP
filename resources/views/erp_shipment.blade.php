@extends('layouts.erp')
@section('description', 'ERP進出貨管理')
@section('keywords', 'ERP')
@section('title', '進出貨管理')
@section('style')
@endsection
@section('header')
	<input type="hidden" name="session_type" id="sort1" value="{{$sort}}">
	<input type="hidden" name="session_type" id="sort2" value="{{$rule}}">
	<form class="form-inline" id="addform" action="import_shipment" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<label class="control-label">請選擇要匯入的CSV檔案：</label>
			<input type="file" class="form-control" name="file">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</div>
		<button type="submit" class="btn btn-danger">匯入CSV</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_shipment'">匯出CSV</button>
	</form>
	<form class="form-inline" id="searchform">
		<div class="form-group">
			<label class="control-label">輸入關鍵字：</label>
			<input type="text"  class="form-control" id="search" name="search" placeholder="人名、公司、編號">
			<button type="submit" class="btn btn-default btn-sm" id="btn_search">搜尋</button>
			<a href="erp_shipment_add" class="btn btn-primary btn-sm">新增資料</a>
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
							<th><a href="?sort=shipment_num&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="shipment_num">出貨單號</th>
							<th><a href="?sort=company&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="company">公司</th>
							<th><a href="?sort=case_num&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="case_num">訂單編號</th>
							<th><a href="?sort=contact&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="contact">聯絡人</th>
							<th><a href="?sort=address&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="address">地址</th>
							<th><a href="?sort=item&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="item">品項</th>			
							<th><a href="?sort=quantity&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="quantity">數量</th>
							<th><a href="?sort=remarks&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="remarks">備註</th>
						</tr>										
						@foreach($shipments as $shipment)
						<tr>
							<td><a href="edit_shipment?i={{ $shipment->num}}" class="btn btn-success">編輯</a><a href="print_shipment?i={{ $shipment->num}}" target="_blank" class="btn btn-success">列印</a></td>							
							<td>{{ $shipment->num}} </td>
							<td>{{ $shipment->shipment_num}}</td>
							<td>{{ $shipment->company}}</td>
							<td>{{ $shipment->case_num}}</td>
							<td>{{ $shipment->contact}}</td>
							<td>{{ $shipment->address}}</td>
							<td>{{ $shipment->item}}</td>
							<td>{{ $shipment->quantity}}</td>
							<td>{{ $shipment->remarks}}</td>
						</tr>
						@endforeach												
					</table>
				</div>
				<div>
					{{ $shipments->appends(['sort' => $_GET['sort'],'rule' => $_GET['rule'],'search' => $_GET['search']])->render() }}
				</div>
			</div>
		</div>
	</div>
@endsection