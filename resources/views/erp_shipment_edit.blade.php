@extends('layouts.erp')
@section('description', 'ERP進出貨管理')
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
								<label class="col-md-4 control-label">出貨單號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="shipment_num" name="shipment_num" value="{{ $datas->shipment_num }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">公司:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="company" name="company" value="{{ $datas->company }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">案號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="case_num" name="case_num" value="{{ $datas->case_num }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">聯絡人:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="contact" name="contact" value="{{ $datas->contact }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">地址:</label>
								<div class="col-md-6">
                                   <input type="text"  class="form-control" id="address" name="address" value="{{ $datas->address }}" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">品項:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="item" name="item" value="{{ $datas->item }}" >			
								</div>
							
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">數量:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="quantity" name="quantity" value="{{ $datas->quantity }}" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">備註:</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="remarks" name="remarks" value="{{ $datas->remarks }}">			
								</div>
							</div>	
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="button" class="btn btn-primary" id="button01">儲存</button>
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
            var num=$("#num").val();
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
              url: "{{ url('update_shipment') }}",  
              data: {   
				_token:$("#csrf").val(),
                num:num,
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