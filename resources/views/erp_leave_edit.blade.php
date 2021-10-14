@extends('layouts.erp')
@section('description', 'ERP請假編輯')
@section('keywords', 'ERP')
@section('title', '請假編輯')
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
					<div class="panel-heading">編輯資料</div>

					<div class="panel-body">
						<form class="form-horizontal" id="register_form">
							{{ csrf_field() }}
                            <div class="form-group">
								<label class="col-md-4 control-label">編號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="id" name="id" value="{{ $datas->id }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">姓名:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="name" name="name" value="{{ $datas->name }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">職稱:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="title" name="title" value="{{ $datas->title }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">到職日:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="take_office" name="take_office" value="{{ $datas->take_office }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">假別:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="type" name="type" value="{{ $datas->type }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">請假原因:</label>
								<div class="col-md-6">
                                   <input type="text"  class="form-control" id="reason" name="reason" value="{{ $datas->reason }}" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">起始日:</label>		
								<div class="col-md-6">
									<div id="app">
											<vue-datepicker-local v-model="time" format="YYYY-MM-DD HH:mm:ss" type="text" id="start_time" name="start_time" value="{{ $datas->start_time }}" required autofocus></vue-datepicker-local>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">結束日:</label>		
								<div class="col-md-6">
									<div id="app2">
											<vue-datepicker-local v-model="time" format="YYYY-MM-DD HH:mm:ss" type="text" id="end_time" name="end_time" value="{{ $datas->end_time }}" required autofocus></vue-datepicker-local>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">共計天數:</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="total" name="total" value="{{ $datas->total }}">			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">狀態:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="status" name="status" value="{{ $datas->status }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="button" class="btn btn-primary" id="button01">儲存</button>
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
			var num={{ $datas->leave_num }};
            var id=$("#id").val();
			var name=$("#name").val();
			var title=$("#title").val();
			var take_office=$("#take_office").val();
			var type=$("#type").val();
			var reason=$("#reason").val();
			var start_time=$("input[name='start_time']").val();
			var end_time=$("input[name='end_time']").val();
			var total=$("#total").val();
			var status=$("#status").val();
            $.ajax({
			  type: "post",
              url: "{{ url('update_leave') }}",  
              data: {   
				_token:$("#csrf").val(),
				num:num,
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
                   alert("無資料變更");
                  }
		                       
              },
			  error: function(data,xhr, status, error){
					console.log(data);
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
			  },
          });
		});	

		$("#test").on("click",function(){
				
				$.ajax({
				   type: 'GET',                     
				   url: "/status", 
				   cache: false,  
				  
				   success: function(data){  
				  //alert(result);
				  //$('#title').text(result);
				
				  $('#test1').val(data);			  	
				   },
				    error: function(xhr, status, error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
				   },
			   });
			});	
		
	</script>
@endsection