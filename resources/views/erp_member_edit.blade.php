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
									<input type="text"  class="form-control" id="id" name="id" value="{{ $datas->id }}" disabled>			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">權限:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="level" name="level" value="{{ $datas->level }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">名字:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="first_name" name="first_name" value="{{ $datas->first_name }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">姓氏:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="last_name" name="last_name" value="{{ $datas->last_name }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">暱稱:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="nickname" name="nickname" value="{{ $datas->nickname }}" >			
								</div>	
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">email:</label>
								<div class="col-md-6">
                                   <input type="text"  class="form-control" id="email" name="email" value="{{ $datas->email }}" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">電話:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="phone" name="phone" value="{{ $datas->phone }}" >			
								</div>
							
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">生日:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="birthday" name="birthday" value="{{ $datas->birthday }}" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">到職日:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="start_office_date" name="start_office_date" value="{{ $datas->start_office_date }}" >			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">部門:</label>
								<div class="col-md-6">
									<input type="text"  class="form-control" id="department" name="department" value="{{ $datas->department }}">			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">職稱:</label>		
								<div class="col-md-6">
									<input type="text"  class="form-control" id="title" name="title" value="{{ $datas->title }}" >			
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
			var level=$("#level").val();
			var first_name=$("#first_name").val();
			var last_name=$("#last_name").val();
			var nickname=$("#nickname").val();
			var email=$("#email").val();
			var phone=$("#phone").val();
			var birthday=$("#birthday").val();
			var start_office_date=$("#start_office_date").val();		
			var department=$("#department").val();
			var title=$("#title").val();
            $.ajax({
			  type: "post",
              url: "{{ url('update_member') }}",  
              data: {   
				_token:$("#csrf").val(),
                id:id,
                level:level,
                first_name:first_name,
                last_name:last_name,
                nickname:nickname,
                email:email,
                phone:phone,		
                birthday:birthday,
				start_office_date:start_office_date,
                department:department,
				title:title
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

	
	</script>
@endsection