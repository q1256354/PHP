@extends('layouts.doc')
@section('description', 'ERP進出貨管理')
@section('keywords', 'ERP')
@section('title', '顧客資料列表')
@section('style')
	<link rel="stylesheet" href="/css/print.css">
@endsection
@section('header')

@endsection
@section('sidebar')
@endsection
@section('content')
	
<div class="print_main" id="print_main" >
	<div class="title">
		<label class="label1">出貨單</label>
	</div>
	<div class="print_form">
		<div class="css_table">
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td-title" style="width: 50%;">收貨人:<input type="text"  class="form-control" id="contact" value="{{ $datas->contact }}"></div>
							<div class="sub-table-td-title" style="width: 50%;">列印日期:<input type="text"  class="form-control" id="date" ></div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td-title" style="width: 100%;">運送地點:<input type="text"  class="form-control" id="address" value="{{ $datas->address }}"></div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td-title" style="width: 100%;">案號:<input type="text"  class="form-control" id="case_num" value="{{ $datas->case_num }}"></div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="css_table">
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="css_th" style="width: 50%;">品名</div>
							<div class="css_th" style="width: 50%;">數量</div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td" style="width: 50%;"><textarea type="text" rows="4"  class="form-control" id="item" value="{{ $datas->item }}">{{ $datas->item }}</textarea></div>
							<div class="sub-table-td" style="width: 50%;"><textarea type="text" rows="4"  class="form-control" id="count" value="{{ $datas->quantity }}">{{ $datas->quantity }}</textarea></div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="css_th" style="width: 50%;">備註</div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td" style="width: 50%;"><textarea type="text" rows="3"  class="form-control" id="remark" value="{{ $datas->remarks }}">出貨編號:{{ $datas->shipment_num }}</textarea></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="css_table">
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="css_th" style="width: 50%;">承辦人/日期</div>
							<div class="css_th" style="width: 50%;">收貨人/日期</div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td" style="height:50px; width: 50%;"><input type="text"  class="form-control" id="contact_sign"></div>
							<div class="sub-table-td" style="width: 50%;"><input type="text"  class="form-control" id="staff_sign"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _
	<div class="title">
		<label class="label1">出貨單</label>
	</div>
	<div class="print_form">
		<div class="css_table">
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td-title" style="width: 50%;">收貨人:<input type="text"  class="form-control" id="contact2"></div>
							<div class="sub-table-td-title" style="width: 50%;">列印日期:<input type="text"  class="form-control" id="date2"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td-title" style="width: 100%;">運送地點:<input type="text"  class="form-control" id="address2"></div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td-title" style="width: 100%;">案號:<input type="text"  class="form-control" id="case_num2"></div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="css_table">
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="css_th" style="width: 50%;">品名</div>
							<div class="css_th" style="width: 50%;">數量</div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td" style="width: 50%;"><textarea type="text" rows="4"  class="form-control" id="item2"></textarea></div>
							<div class="sub-table-td" style="width: 50%;"><textarea type="text" rows="4"  class="form-control" id="count2"></textarea></div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="css_th" style="width: 50%;">備註</div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td" style="width: 50%;"><textarea type="text" rows="3"  class="form-control" id="remark2"></textarea></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="css_table">
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="css_th" style="width: 50%;">承辦人/日期</div>
							<div class="css_th" style="width: 50%;">收貨人/日期</div>
						</div>
					</div>
				</div>
			</div>
			<div class="css_tr">
				<div class="css_td">
					<div class="sub-table">
						<div class="sub-table-tr">
							<div class="sub-table-td" style="height:50px; width: 50%;"><input type="text"  class="form-control" id="contact_sign2"></div>
							<div class="sub-table-td" style="width: 50%;"><input type="text"  class="form-control" id="staff_sign2"></div>
						</div>
					</div>
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
	var dt = new Date();
	var nowMonth = dt.getMonth() + 1;
	var strDate = dt.getDate();
	if (nowMonth >= 1 && nowMonth <= 9) {
	   nowMonth = "0" + nowMonth;
	}
	if (strDate >= 0 && strDate <= 9) {
	   strDate = "0" + strDate;
	}
	var nowDate = dt.getFullYear() + "-" + nowMonth + "-" + strDate;

		$(document).on("ready", function(){	
		$("#date").val(nowDate);
		$("#contact2").val($("#contact").val());
		$("#date2").val($("#date").val());
		$("#address2").val($("#address").val());
		$("#case_num2").val($("#case_num").val());
		$("#item2").val($("#item").val());
		$("#count2").val($("#count").val());
		$("#remark2").val($("#remark").val());
		
		});	
		var control=$(".form-control");
		$(control).on("change", function(e){
		$("#contact2").val($("#contact").val());
		$("#date2").val($("#date").val());
		$("#address2").val($("#address").val());
		$("#case_num2").val($("#case_num").val());
		$("#item2").val($("#item").val());
		$("#count2").val($("#count").val());
		$("#remark2").val($("#remark").val());
		
		});
		
	</script>
@endsection