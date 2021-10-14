@extends('layouts.erp')
@section('description', 'ERP請假卡')
@section('keywords', 'ERP')
@section('title', '請假卡')
@section('style')
@endsection
@section('header')
	<input type="hidden" name="session_type" id="sort1" value="{{$sort}}">
	<input type="hidden" name="session_type" id="sort2" value="{{$rule}}">
	<form class="form-inline" id="addform" action="import_leave" method="post" enctype="multipart/form-data"> 
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_leave'">匯出CSV</button>
	</form>
	<form class="form-inline" id="searchform">
		<div class="form-group">
			<label class="control-label">輸入關鍵字：</label>
			<input type="text"  class="form-control" id="search" name="search" placeholder="人名、公司、編號">
			<button type="submit" class="btn btn-default btn-sm" id="btn_search">搜尋</button>
			<a href="erp_leave_add" class="btn btn-primary btn-sm">新增資料</a>
		</div>
	</form>
@endsection
@section('sidebar')
@endsection
@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover table-condensed">
					{{ csrf_field() }}
						<tr>
							<th>動作</th>
							<th><a href="?sort=leave_num&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="leave_num">編號</th>
							<th><a href="?sort=id&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="id">ID</th>
							<th><a href="?sort=name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="name">姓名</th>
							<th><a href="?sort=title&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="title">職稱</th>
							<th><a href="?sort=take_office&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="take_office">到職日</th>
							<th><a href="?sort=type&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="type">假別</th>
							<th><a href="?sort=reason&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="reason">原因</th>
							<th><a href="?sort=start_time&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="start_time">開始時間</th>			
							<th><a href="?sort=end_time&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="end_time">結束時間</th>
							<th><a href="?sort=total&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="total">總天數</th>
							<th><a href="?sort=status&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="status">狀態</th>
							<th><a href="?sort=created_at&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="created_at">申請日期</th>
							<th><a href="?sort=updated_at&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="updated_at">更新時間</th>
						</tr>										
						@foreach($leaves as $leave)
						<tr class="list">
							<td>
							@if ($leave->status=="未審核")
							<a href="javascript:void(0);" class="btn btn-success edit btn-sm edit{{ $leave->leave_num}}" data-edit="{{$leave->leave_num}}">編輯</a>
							<a href="javascript:void(0);" class="btn btn-success save btn-sm leave_num{{ $leave->leave_num}}" data-save="{{$leave->leave_num}}" style="display:none;">儲存</a>
								@if(Auth::user()->level>=5)
									<a href="javascript:void(0);" class="btn btn-primary approve btn-sm" data-num="{{$leave->leave_num}}">核准</a>
									<a href="javascript:void(0);" class="btn btn-danger reject btn-sm" data-num2="{{$leave->leave_num}}">駁回</a>
								@endif
							@endif
							</td>							
							<td>{{ $leave->leave_num}}</td>
							<td>{{ $leave->id}}</td>
							<td>{{ $leave->name}}</td>
							<td>{{ $leave->title}}</td>
							<td>{{ $leave->take_office}}</td>	
							<td><p class="edit{{ $leave->leave_num}}" id="ptype{{ $leave->leave_num}}">{{ $leave->type}}</p><input type="text"  class="form-control input leave_num{{ $leave->leave_num}}" id="type{{ $leave->leave_num}}" data-input="{{ $leave->leave_num}}" value="{{ $leave->type}}" style="display:none;"></td>	
							<td><p class="edit{{ $leave->leave_num}}" id="preason{{ $leave->leave_num}}">{{ $leave->reason}}</p><input type="text"  class="form-control input leave_num{{ $leave->leave_num}}" id="reason{{ $leave->leave_num}}" data-input="{{ $leave->leave_num}}" value="{{ $leave->reason}}" style="display:none;"></td>
							<td><p class="edit{{ $leave->leave_num}}" id="pstart_time{{ $leave->leave_num}}">{{ $leave->start_time}}</p><input type="text"  class="form-control input leave_num{{ $leave->leave_num}}" id="start_time{{ $leave->leave_num}}" data-input="{{ $leave->leave_num}}" value="{{ $leave->start_time}}" style="display:none;"></td>
							<td><p class="edit{{ $leave->leave_num}}" id="pend_time{{ $leave->leave_num}}">{{ $leave->end_time}}</p><input type="text"  class="form-control input leave_num{{ $leave->leave_num}}" id="end_time{{ $leave->leave_num}}" data-input="{{ $leave->leave_num}}" value="{{ $leave->end_time}}" style="display:none;"></td>
							<td><p class="edit{{ $leave->leave_num}}" id="ptotal{{ $leave->leave_num}}">{{ $leave->total}}</p><input type="text"  class="form-control input leave_num{{ $leave->leave_num}}" id="total{{ $leave->leave_num}}" data-input="{{ $leave->leave_num}}" value="{{ $leave->total}}" style="display:none;"></td>
							<td>{{ $leave->status}}</td>
							<td>{{ $leave->created_at}}</td>
							<td>{{ $leave->updated_at}}</td>
						</tr>
						@endforeach												
					</table>
				</div>
				<div>
					{{ $leaves->appends(['sort' => $_GET['sort'],'rule' => $_GET['rule'],'search' => $_GET['search']])->render() }}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });		
		$(document).on("ready", function(){
		var list=$(".list");
			$("a.edit").on("click", function(){
				var number=$(this).attr("data-edit");
				$('.leave_num'+number+'').show();
				$('.edit'+number+'').hide();
			});

			$("a.save").on("click", function(){
				var number=$(this).attr("data-save");
				$('.leave_num'+number+'').hide();
				$('.edit'+number+'').show();
				var type=$("#type"+number+"").val();
				var reason=$("#reason"+number+"").val();
				var start_time=$("#start_time"+number+"").val();
				var end_time=$("#end_time"+number+"").val();
				var total=$("#total"+number+"").val();
				$.ajax({
						type: "post",
						url: "{{ url('update_leave') }}",  
						data: {   
							_token:$("#csrf").val(),
							num:$(this).attr("data-save"),							
							type:type,
							reason:reason,
							start_time:start_time,		
							end_time:end_time,
							total:total
						},
						cache: false,
						success: function(data){  
							//console.log(data);		
							if(data=="ok"){           
								alert("success");
							} 
										
						},
						error: function(data,xhr, status, error){
								alert("fail");
								console.log(data);
								console.log(xhr);
								console.log(status);
								console.log(error);
						},
					});
			});

			$(list).on("change",".input", function(e){
				var num = $(this).attr("data-input");
				$("#ptype"+num+"").html($("#type"+num+"").val());
				$("#preason"+num+"").html($("#reason"+num+"").val());
				$("#pstart_time"+num+"").html($("#start_time"+num+"").val());
				$("#pend_time"+num+"").html($("#end_time"+num+"").val());
				$("#ptotal"+num+"").html($("#total"+num+"").val());

			});

			$("a.approve").on("click", function(){
				var c=confirm("確認核准？");
				if(c){
					$.ajax({
						type: "post",
						url: "{{ url('review_leave') }}",  
						data: {   
							_token:$("#csrf").val(),
							num:$(this).attr("data-num"),							
							status:'核准'	
						},
						cache: false,
						success: function(data){  
							console.log(data);		
							if(data=="ok"){           
								alert("success");
							} 
										
						},
						error: function(data,xhr, status, error){
								alert("fail");
								console.log(data);
								console.log(xhr);
								console.log(status);
								console.log(error);
						},
					});
				}

			});
			$("a.reject").on("click", function(){
				var d=confirm("確認駁回？");
				if(d){
					$.ajax({
						type: "post",
						url: "{{ url('review_leave') }}",  
						data: {   
							_token:$("#csrf").val(),
							num:$(this).attr("data-num2"),							
							status:'駁回'	
						},
						cache: false,
						success: function(data){  
							console.log(data);		
							if(data=="ok"){           
								alert("success");
								window.location.href = "erp_leave";
							} 
										
						},
						error: function(data,xhr, status, error){
								alert("fail");
								console.log(data);
								console.log(xhr);
								console.log(status);
								console.log(error);
						},
					});
				}

			});
		});
	</script>
@endsection