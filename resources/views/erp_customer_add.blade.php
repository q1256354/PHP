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
								<label class="col-md-4 control-label">顧客姓名(中文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="name" name="name" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">名字(中文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="first_name" name="first_name" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">姓氏(中文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="last_name" name="last_name" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">公司全名(中文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="company_name" name="company_name" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">公司全名(英文):</label>
								<div class="col-md-6">
                                    <input type="text"  class="form-control" id="company_name_eng" name="company_name_eng" placeholder="" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">職稱(中文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="title" name="title" placeholder="" >			
								</div>
							
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">部門(中文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="department" name="department" placeholder="" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">地址(中文):</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="address" name="address" placeholder="">			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">電話:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="phone" name="phone" placeholder="" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">傳真:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="fax" name="fax" placeholder="" >			
								</div>
							</div>	
                            <div class="form-group">
								<label class="col-md-4 control-label">手機:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="cellphone" name="cellphone" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">電子郵件:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="email" name="email" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">網址:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="url" name="url" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">類別:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="type" name="type" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">統一編號:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="tax_number" name="tax_number" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">repeat:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="repeat_status" name="repeat_status" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">顧客姓名(英文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="name_eng" name="name_eng" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">職稱(英文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="title_eng" name="title_eng" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">部門(英文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="department_eng" name="department_eng" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">地址(英文):</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="address_eng" name="address_eng" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">備註:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="remark" name="remark" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">類別:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="kind" name="kind" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">排程:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="queue" name="queue" placeholder="" >			
								</div>
							</div>
                            <div class="form-group">
								<label class="col-md-4 control-label">領域:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="specialization" name="specialization" placeholder="" >			
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
			var name=$("#name").val();
			var first_name=$("#first_name").val();
			var last_name=$("#last_name").val();
			var company_name=$("#company_name").val();
			var company_name_eng=$("#company_name_eng").val();
			var title=$("#title").val();
			var department=$("#department").val();
			var address=$("#address").val();
			var phone=$("#phone").val();
            var fax=$("#fax").val();
            var cellphone=$("#cellphone").val();
            var email=$("#email").val();
            var url=$("#url").val();
            var type=$("#type").val();
            var tax_number=$("#tax_number").val();
            var repeat_status=$("#repeat_status").val();
            var name_eng=$("#name_eng").val();
            var title_eng=$("#title_eng").val();
            var department_eng=$("#department_eng").val();
            var address_eng=$("#address_eng").val();
            var remark=$("#remark").val();
            var kind=$("#kind").val();
            var queue=$("#queue").val();
            var specialization=$("#specialization").val();
            $.ajax({
			  type: "post",
              url: "{{ url('add_customer') }}",  
              data: {   
				_token:$("#csrf").val(),
                name:name,
                first_name:first_name,
                last_name:last_name,
                company_name:company_name,
                company_name_eng:company_name_eng,
                title:title,		
                department:department,
                address:address,
                phone:phone,
                fax:fax,
                cellphone:cellphone,
                email:email,
                url:url,
                type:type,
                tax_number:tax_number,
                repeat_status:repeat_status,
                name_eng:name_eng,
                title_eng:title_eng,
                department_eng:department_eng,
                address_eng:address_eng,
                remark:remark,
                kind:kind,
                queue:queue,
                specialization:specialization
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

		
		
	</script>
@endsection