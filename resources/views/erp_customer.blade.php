@extends('layouts.erp')
@section('description', 'ERP顧客資料列表')
@section('keywords', 'ERP')
@section('title', '顧客資料列表')
@section('style')
@endsection
@section('header')
	<input type="hidden" name="session_type" id="sort1" value="{{$sort}}">
	<input type="hidden" name="session_type" id="sort2" value="{{$rule}}">
	<form class="form-inline" id="addform" action="import_customer" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<label class="control-label">請選擇要匯入的CSV檔案：</label>
			<input type="file" class="form-control" name="file">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</div>
		<button type="submit" class="btn btn-danger">匯入CSV</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_customer'">匯出CSV</button>
		
	</form>
	<form class="form-inline" id="addform2" action="import_customer_excel" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<label class="control-label">請選擇要匯入的Xlsx檔案：</label>
			<input type="file" class="form-control" name="import_file">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</div>	
		<button type="submit" class="btn btn-danger">匯入Excel</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href='export_customer_excel'">匯出Excel</button>
	</form>
	<form class="form-inline" id="searchform">
		<div class="form-group">
			<label class="control-label">輸入關鍵字：</label>
			<input type="text"  class="form-control" id="search" name="search" placeholder="人名、公司、編號">
			<button type="submit" class="btn btn-default btn-sm" id="btn_search">搜尋</button>
			<a href="erp_customer_add" class="btn btn-primary btn-sm">新增資料</a>
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
						<tr>
							<th>動作</th>
							<th><a href="?sort=num&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="num">編號</th>
							<th><a href="?sort=name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="name">全名</th>
							<th><a href="?sort=first_name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="first_name">名字</th>
							<th><a href="?sort=last_name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="last_name">姓氏</th>
							<th><a href="?sort=company_name&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="company_name">公司</th>
							<th><a href="?sort=company_name_eng&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="company_name_eng">公司英文名</th>
							<th><a href="?sort=title&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="title">職稱</th>			
							<th><a href="?sort=department&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="department">部門</th>
							<th><a href="?sort=address&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="address">商務地址</th>
							<th><a href="?sort=phone&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="phone">商務電話</th>
							<th><a href="?sort=fax&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="fax">商務傳真</th>
							<th><a href="?sort=cellphone&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="cellphone">手機電話</th>
							<th><a href="?sort=email&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="email">商務電子郵件</th>
							<th><a href="?sort=url&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="url">商務網址</th>
							<th><a href="?sort=type&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="type">類別</th>
							<th><a href="?sort=tax_number&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="tax_number">統一編號</th>
							<th><a href="?sort=repeat_status&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="repeat_status">Repeat</th>
							<th><a href="?sort=name_eng&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="name_eng">姓名(英文)</th>
							<th><a href="?sort=title_eng&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="title_eng">職稱(英文)</th>
							<th><a href="?sort=department_eng&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="department_eng">部門(英文)</th>
							<th><a href="?sort=address_eng&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="address_eng">商務地址(英文)</th>
							<th><a href="?sort=remark&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="remark">備註</th>
							<th><a href="?sort=kind&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="kind">分類</th>
							<th><a href="?sort=queue&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="queue">排程</th>
							<th><a href="?sort=specialization&rule={{$rule}}&search={{$search}}" class="btn btn-success btn-sm" id="specialization">領域</th>
						</tr>										
						@foreach($customers as $customer)
						<tr class="list">
							<td>
							<a href="javascript:void(0);" class="btn btn-success edit btn-sm edit{{ $customer->num}}" data-edit="{{ $customer->num}}">編輯</a>
							<a href="javascript:void(0);" class="btn btn-success save btn-sm num{{ $customer->num}}" data-save="{{ $customer->num}}" style="display:none;">儲存</a>
							</td>							
							<td>{{ $customer->num}}</td>
							<td><p class="edit{{ $customer->num}}" id="pname{{ $customer->num}}">{{ $customer->name}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="name{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->name}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pfirst_name{{ $customer->num}}">{{ $customer->first_name}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="first_name{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->first_name}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="plast_name{{ $customer->num}}">{{ $customer->last_name}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="last_name{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->last_name}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pcompany_name{{ $customer->num}}">{{ $customer->company_name}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="company_name{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->company_name}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pcompany_name_eng{{ $customer->num}}">{{ $customer->company_name_eng}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="company_name_eng{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->company_name_eng}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="ptitle{{ $customer->num}}">{{ $customer->title}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="title{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->title}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pdepartment{{ $customer->num}}">{{ $customer->department}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="department{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->department}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="paddress{{ $customer->num}}">{{ $customer->address}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="address{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->address}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pphone{{ $customer->num}}">{{ $customer->phone}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="phone{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->phone}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pfax{{ $customer->num}}">{{ $customer->fax}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="fax{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->fax}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pcellphone{{ $customer->num}}">{{ $customer->cellphone}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="cellphone{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->cellphone}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pemail{{ $customer->num}}">{{ $customer->email}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="email{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->email}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="purl{{ $customer->num}}">{{ $customer->url}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="url{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->url}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="ptype{{ $customer->num}}">{{ $customer->type}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="type{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->type}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="ptax_number{{ $customer->num}}">{{ $customer->tax_number}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="tax_number{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->tax_number}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="prepeat_status{{ $customer->num}}">{{ $customer->repeat_status}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="repeat_status{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->repeat_status}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pname_eng{{ $customer->num}}">{{ $customer->name_eng}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="name_eng{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->name_eng}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="ptitle_eng{{ $customer->num}}">{{ $customer->title_eng}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="title_eng{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->title_eng}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pdepartment_eng{{ $customer->num}}">{{ $customer->department_eng}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="department_eng{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->department_eng}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="paddress_eng{{ $customer->num}}">{{ $customer->address_eng}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="address_eng{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->address_eng}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="premark{{ $customer->num}}">{{ $customer->remark}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="remark{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->remark}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pkind{{ $customer->num}}">{{ $customer->kind}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="kind{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->kind}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pqueue{{ $customer->num}}">{{ $customer->queue}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="queue{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->queue}}" style="display:none;"></td>
							<td><p class="edit{{ $customer->num}}" id="pspecialization{{ $customer->num}}">{{ $customer->specialization}}</p><input type="text"  class="form-control input num{{ $customer->num}}" id="specialization{{ $customer->num}}" data-input="{{ $customer->num}}" value="{{ $customer->specialization}}" style="display:none;"></td>							
							<!--td>{{ $customer->name}}</td>
							<td>{{ $customer->first_name}}</td>
							<td>{{ $customer->last_name}}</td>
							<td>{{ $customer->company_name}}</td>
							<td>{{ $customer->company_name_eng}}</td>	
							<td>{{ $customer->title}}</td>
							<td>{{ $customer->department}}</td>
							<td>{{ $customer->address}}</td>
							<td>{{ $customer->phone}}</td>
							<td>{{ $customer->fax}}</td>
							<td>{{ $customer->cellphone}}</td>
							<td>{{ $customer->email}}</td>
							<td>{{ $customer->url}}</td>
							<td>{{ $customer->type}}</td>
							<td>{{ $customer->tax_number}}</td>
							<td>{{ $customer->repeat_status}}</td>
							<td>{{ $customer->name_eng}}</td>
							<td>{{ $customer->title_eng}}</td>
							<td>{{ $customer->department_eng}}</td>
							<td>{{ $customer->address_eng}}</td>
							<td>{{ $customer->remark}}</td>
							<td>{{ $customer->kind}}</td>
							<td>{{ $customer->queue}}</td>
							<td>{{ $customer->specialization}}</td-->
						</tr>
						@endforeach												
					</table>
				</div>
				<div>
					{{ $customers->appends(['sort' => $_GET['sort'],'rule' => $_GET['rule'],'search' => $_GET['search']])->render() }}
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
				$('.num'+number+'').show();
				$('.edit'+number+'').hide();
			});

			$("a.save").on("click", function(){
				var number=$(this).attr("data-save");
				$('.num'+number+'').hide();
				$('.edit'+number+'').show();
				var name=$("#name"+number+"").val();
				var first_name=$("#first_name"+number+"").val();
				var last_name=$("#last_name"+number+"").val();
				var company_name=$("#company_name"+number+"").val();
				var company_name_eng=$("#company_name_eng"+number+"").val();
				var title=$("#title"+number+"").val();
				var department=$("#department"+number+"").val();
				var address=$("#address"+number+"").val();
				var phone=$("#phone"+number+"").val();
				var fax=$("#fax"+number+"").val();
				var cellphone=$("#cellphone"+number+"").val();
				var email=$("#email"+number+"").val();
				var url=$("#url"+number+"").val();
				var type=$("#type"+number+"").val();
				var tax_number=$("#tax_number"+number+"").val();
				var repeat_status=$("#repeat_status"+number+"").val();
				var name_eng=$("#name_eng"+number+"").val();
				var title_eng=$("#title_eng"+number+"").val();
				var department_eng=$("#department_eng"+number+"").val();
				var address_eng=$("#address_eng"+number+"").val();
				var remark=$("#remark"+number+"").val();
				var kind=$("#kind"+number+"").val();
				var queue=$("#queue"+number+"").val();
				var specialization=$("#specialization"+number+"").val();
				$.ajax({
						type: "post",
						url: "{{ url('update_customer') }}",  
						data: {   
							_token:$("#csrf").val(),
							num:$(this).attr("data-save"),							
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
				$("#pname"+num+"").html($("#name"+num+"").val());
				$("#pfirst_name"+num+"").html($("#first_name"+num+"").val());
				$("#plast_name"+num+"").html($("#last_name"+num+"").val());
				$("#pcompany_name"+num+"").html($("#company_name"+num+"").val());
				$("#pcompany_name_eng"+num+"").html($("#company_name_eng"+num+"").val());
				$("#ptitle"+num+"").html($("#title"+num+"").val());
				$("#pdepartment"+num+"").html($("#department"+num+"").val());
				$("#paddress"+num+"").html($("#address"+num+"").val());
				$("#pphone"+num+"").html($("#phone"+num+"").val());
				$("#pfax"+num+"").html($("#fax"+num+"").val());
				$("#pcellphone"+num+"").html($("#cellphone"+num+"").val());
				$("#pemail"+num+"").html($("#email"+num+"").val());
				$("#purl"+num+"").html($("#url"+num+"").val());
				$("#ptype"+num+"").html($("#type"+num+"").val());
				$("#ptax_number"+num+"").html($("#tax_number"+num+"").val());
				$("#prepeat_status"+num+"").html($("#repeat_status"+num+"").val());
				$("#pname_eng"+num+"").html($("#name_eng"+num+"").val());
				$("#ptitle_eng"+num+"").html($("#title_eng"+num+"").val());
				$("#pdepartment_eng"+num+"").html($("#department_eng"+num+"").val());
				$("#paddress_eng"+num+"").html($("#address_eng"+num+"").val());
				$("#premark"+num+"").html($("#remark"+num+"").val());
				$("#pkind"+num+"").html($("#kind"+num+"").val());
				$("#pqueue"+num+"").html($("#queue"+num+"").val());
				$("#pspecialization"+num+"").html($("#specialization"+num+"").val());
			});				
		});
	</script>
@endsection