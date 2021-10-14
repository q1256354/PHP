@extends('layouts.erp')
@section('description', 'ERP設備維護管理')
@section('keywords', 'ERP')
@section('title', '設備維護管理新增')
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
					<div class="panel-heading">維修申請單</div>

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
								<label class="col-md-4 control-label">申請原因:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="reason" name="reason" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">狀態:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="status" name="status" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">申請人:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="applicant" name="applicant" placeholder="" >			
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
									<a href="erp_repair" class="btn btn-primary">取消</a>
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
			var reason=$("#reason").val();
			var status=$("#status").val();
			var applicant=$("#applicant").val();
			var remarks=$("#remarks").val();
            $.ajax({
			  type: "post",
              url: "{{ url('add_repair') }}",  
              data: {   
				_token:$("#csrf").val(),
                item:item,
                reason:reason,
				status:status,
                applicant:applicant,
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