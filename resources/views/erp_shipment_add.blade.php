@extends('layouts.erp')
@section('description', 'ERP顧客資料列表')
@section('keywords', 'ERP')
@section('title', '顧客資料列表')
@section('style')
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
								<label class="col-md-4 control-label">出貨單號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="shipment_num" name="shipment_num" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">公司:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="company" name="company" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">訂單編號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="case_num" name="case_num" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">聯絡人:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="contact" name="contact" placeholder="" >			
								</div>
							
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">地址:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="address" name="address" placeholder="" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">品項:</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="item" name="item" placeholder="">			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">數量:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="quantity" name="quantity" placeholder="" >			
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
									<a href="erp_shipment" class="btn btn-primary">取消</a>
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
			var shipment_num=$("#shipment_num").val();
			var company=$("#company").val();
			var case_num=$("#case_num").val();
			var contact=$("#contact").val();
			var address=$("#address").val();
			var item=$("#item").val();
			var quantity=$("#quantity").val();
			var remarks=$("#remarks").val();
            $.ajax({
			  type: "post",
              url: "{{ url('add_shipment') }}",  
              data: {   
				_token:$("#csrf").val(),
                shipment_num:shipment_num,
                company:company,
                case_num:case_num,
                contact:contact,
                address:address,
                item:item,		
                quantity:quantity,
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