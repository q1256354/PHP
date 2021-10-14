@extends('layouts.erp')
@section('description', 'ERP請假卡')
@section('keywords', 'ERP')
@section('title', '新增假單')
@section('style')
	<link rel="stylesheet" href="/css/vue-datepicker-local.css">
@endsection
@section('header')

@endsection
@section('sidebar')
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">新增資料</div>

					<div class="panel-body">
						<form class="form-horizontal" id="register_form">
							{{ csrf_field() }}
							<div class="form-group">
								<label class="col-md-4 control-label">ID:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="id" name="id" value="{{ Auth::user()->id}}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">姓名:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="name" name="name" value="{{ Auth::user()->nickname}}" disabled>		
									@if ($errors->has('account'))
										<span class="help-block">
											<strong>{{ $errors->first('account') }}</strong>
										</span>
									@endif	
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">職稱:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="title" name="title" value="{{ Auth::user()->title}}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">到職日:</label>
								<div class="col-md-6">	
									<input type="text"  class="form-control" id="take_office" name="take_office" value="{{ Auth::user()->start_office_date}}"  disabled>									
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">假別:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="type" name="type" placeholder="" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">請假原因:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="reason" name="reason" placeholder="" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">起始日:</label>
								<div class="col-md-6">
									<div id="app2">
										<vue-datepicker-local v-model="time" format="YYYY-MM-DD HH:mm:ss" type="text" id="start_time" name="start_time" value="{{ old('start_time') }}" required autofocus></vue-datepicker-local>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">結束日:</label>
								<div class="col-md-6">
									<div id="app3">
										<vue-datepicker-local v-model="time" format="YYYY-MM-DD HH:mm:ss" type="text" id="end_time" name="end_time" value="{{ old('end_time') }}" required autofocus></vue-datepicker-local>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">共計天數:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="total" name="total" placeholder="" >			
								</div>	
								@if ($errors->has('total'))
										<span class="help-block">
											<strong>{{ $errors->first('total') }}</strong>
										</span>
								@endif
							</div>
							<!--div class="form-group">
								<label class="col-md-4 control-label">狀態:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="status" name="status" placeholder="" >			
								</div>
							</div-->	
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="button" class="btn btn-primary" id="button01">新增</button>
									<a href="erp_leave" class="btn btn-primary">取消</a>
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
	new Vue({
	el: "#app2",
	data: {
		time: new Date()
	}
	})
	new Vue({
	el: "#app3",
	data: {
		time: new Date()
	}
	})
	</script>
	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">		
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$("#button01").on("click",function()	
		{
			var id=$("#id").val();
			var name=$("#name").val();
			var title=$("#title").val();
			var take_office=$("input[name='take_office']").val();
			var type=$("#type").val();
			var reason=$("#reason").val();
			var start_time=$("input[name='start_time']").val();
			var end_time=$("input[name='end_time']").val();
			var total=$("#total").val();
			var status='未審核';
            $.ajax({
			  type: "post",
              url: "{{ url('add_leave') }}",  
              data: {   
				_token:$("#csrf").val(),
                id:id,
                name:name,
                title:title,
				take_office:take_office,
				type:type,
                reason:reason,
                start_time:start_time,		
                end_time:end_time,
                total:total,
                status:status
              },
              cache: false,
              success: function(data){  
				console.log(data);		
				  if(data=="ok"){           
                    alert("success");
				  } 
				  else{
					alert(data.error);
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

		
	</script>
@endsection