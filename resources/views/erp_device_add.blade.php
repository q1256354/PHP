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
					<div class="panel-heading">新增資料</div>

					<div class="panel-body">
						<form class="form-horizontal" id="register_form">
							{{ csrf_field() }}
							<div class="form-group">
								<label class="col-md-4 control-label">品項:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="item" name="item" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">廠牌:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="label" name="label" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">型號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="model" name="model" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">數量:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="quantity" name="quantity" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">入帳日:</label>
								<div class="col-md-6">
									<div id="app">
										<vue-datepicker-local v-model="time" type="text" id="insert_date" name="insert_date" value="{{ old('insert_date') }}" required autofocus></vue-datepicker-local>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">盤點人員:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="staff" name="staff" placeholder="" >			
								</div>
							
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">用途:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="purpose" name="purpose" placeholder="" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">位置:</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="location" name="location" placeholder="">			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">狀態:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="status" name="status" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">備註:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="remarks" name="remarks" placeholder="" >			
								</div>
							</div>	
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="button" class="btn btn-primary" id="button01">新增</button>
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
              url: "{{ url('add_device') }}",  
              data: {   
				_token:$("#csrf").val(),
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