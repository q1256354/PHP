@extends('layouts.erp')
@section('description', 'ERP顧客資料列表')
@section('keywords', 'ERP')
@section('title', '顧客資料列表')
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
									<input type="text"  class="form-control" id="num" name="num" value="{{ $datas->num }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">品項:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="item" name="item" value="{{ $datas->item }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">廠牌:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="label" name="label" value="{{ $datas->label }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">型號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="model" name="model" value="{{ $datas->model }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">數量:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="quantity" name="quantity" value="{{ $datas->quantity }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">入帳日:</label>
								<div class="col-md-6">
                                   <input type="text"  class="form-control" id="insert_date" name="insert_date" value="{{ $datas->insert_date }}" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">盤點人員:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="staff" name="staff" value="{{ $datas->staff }}" >			
								</div>
							
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">用途:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="purpose" name="purpose" value="{{ $datas->purpose }}" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">位置:</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="location" name="location" value="{{ $datas->location }}">			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">狀態:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="status" name="status" value="{{ $datas->status }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">備註:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="remarks" name="remarks" value="{{ $datas->remarks }}" >			
								</div>
							</div>	
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="button" class="btn btn-primary" id="button01">儲存</button>
									<a href="erp_device" class="btn btn-primary">取消</a>
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
	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">		
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$("#button01").on("click",function()	
		{
            var num=$("#num").val();
			var item=$("#item").val();
			var label=$("#label").val();
			var model=$("#model").val();
			var quantity=$("#quantity").val();
			var insert_date=$("input[name='insert_date']").val();
			var staff=$("#staff").val();
			var purpose=$("#purpose").val();
			var location=$("#location").val();
			var status=$("#status").val();
			var remarks=$("#remarks").val();
            $.ajax({
			  type: "post",
              url: "{{ url('update_device') }}",  
              data: {   
				_token:$("#csrf").val(),
                num:num,
                item:item,
                label:label,
                model:model,
                quantity:quantity,
                insert_date:insert_date,
                staff:staff,		
                purpose:purpose,
                location:location,
                status:status,
                remarks:remarks	
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