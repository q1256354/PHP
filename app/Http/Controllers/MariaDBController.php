<?php

namespace App\Http\Controllers;
use App\DeviceData;
use Illuminate\Http\Request;

class MariaDBController extends Controller
{
    public function index() 
	{
		$members = \DB::table('members_erp')->get();
		
	}
	public function device() 
	{
		if(!isset($_GET['sort'])){
			$_GET['sort']=0;
		}
		if(!isset($_GET['rule'])){
			$_GET['rule']=0;
		}
		if(!isset($_GET['search'])){
			$_GET['search']=0;
		}
		$adata = $_GET['sort'];
		$bdata = $_GET['rule'];
		$cdata = $_GET['search'];
		if($cdata=="0"){
			  if($adata==0&&$bdata==0){
			  $devices = \DB::table('device_list')->Paginate(15); 
			  $rule=1;
			  }
			  else{
				if($bdata==1){
					$devices = \DB::table('device_list')
									->orderBy($adata,'desc')
									->Paginate(15);
					$rule=0;
				}
				elseif($bdata==2){
					$devices = \DB::table('device_list')
									->orderBy($adata,'asc')
									->Paginate(15); 
					$rule=0;
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$devices = \DB::table('device_list')
									->where(\DB::raw('CONCAT(num, item,label,model,quantity,insert_date,staff,purpose,location,status,remarks)'), 'like',"%{$cdata}%")
									->Paginate(15);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$devices = \DB::table('device_list')
									->where(\DB::raw('CONCAT(num, item,label,model,quantity,insert_date,staff,purpose,location,status,remarks)'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(15); 
				$rule=0;
				}
				elseif($bdata==2){
					$devices = \DB::table('device_list')
									->where(\DB::raw('CONCAT(num, item,label,model,quantity,insert_date,staff,purpose,location,status,remarks)'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(15); 
				$rule=1;
				}
			  }
		}
				
	return view('erp_device',['devices'=>$devices,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
					);
	}
	
	public function customer() 
	{
		
		if(!isset($_GET['sort'])){
			$_GET['sort']=0;
		}
		if(!isset($_GET['rule'])){
			$_GET['rule']=0;
		}
		if(!isset($_GET['search'])){
			$_GET['search']=0;
		}
		$adata = $_GET['sort'];
		$bdata = $_GET['rule'];
		$cdata = $_GET['search'];
		if($cdata=="0"){
			  if($adata==0&&$bdata==0){
			  $customers = \DB::table('customer_list')->Paginate(10); 
			  	$rule=1;
			  }
			  else{
				if($bdata==1){
					$customers = \DB::table('customer_list')
									->orderBy($adata,'desc')
									->Paginate(10);
					$rule=0;
				}
				elseif($bdata==2){
					$customers = \DB::table('customer_list')
									->orderBy($adata,'asc')
									->Paginate(10); 
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$customers = \DB::table('customer_list')
									->where(\DB::raw('CONCAT(num, name,first_name,last_name,company_name,company_name_eng,title,department,address,phone,fax,cellphone,email,url,type,tax_number,repeat_status,name_eng,title_eng,department_eng,address_eng,remark,kind,queue,specialization)'), 'like',"%{$cdata}%")
									->Paginate(10);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$customers = \DB::table('customer_list')
									->where(\DB::raw('CONCAT(num, name,first_name,last_name,company_name,company_name_eng,title,department,address,phone,fax,cellphone,email,url,type,tax_number,repeat_status,name_eng,title_eng,department_eng,address_eng,remark,kind,queue,specialization)'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(10); 
				$rule=0;
				}
				elseif($bdata==2){
					$customers = \DB::table('customer_list')
									->where(\DB::raw('CONCAT(num, name,first_name,last_name,company_name,company_name_eng,title,department,address,phone,fax,cellphone,email,url,type,tax_number,repeat_status,name_eng,title_eng,department_eng,address_eng,remark,kind,queue,specialization)'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(10); 
				$rule=1;
				}
			  }
		}
		return view('erp_customer',['customers'=>$customers,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
		);
	}
	public function user() 
	{
		
		if(!isset($_GET['sort'])){
			$_GET['sort']=0;
		}
		if(!isset($_GET['rule'])){
			$_GET['rule']=0;
		}
		if(!isset($_GET['search'])){
			$_GET['search']=0;
		}
		$adata = $_GET['sort'];
		$bdata = $_GET['rule'];
		$cdata = $_GET['search'];
		if($cdata=="0"){
			  if($adata==0&&$bdata==0){
			  $users = \DB::table('users')->Paginate(10); 
			  		$rule=1;
			  }
			  else{
				if($bdata==1){
					$users = \DB::table('users')
									->orderBy($adata,'desc')
									->Paginate(10);
					$rule=2;
				}
				elseif($bdata==2){
					$users = \DB::table('users')
									->orderBy($adata,'asc')
									->Paginate(10); 
					$rule=1;				
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$users = \DB::table('users')
									->where(\DB::raw('CONCAT(id, level, nickname, first_name, last_name, email, phone, birthday, start_office_date, department, title)'), 'like',"%{$cdata}%")
									->Paginate(10);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$users = \DB::table('users')
									->where(\DB::raw('CONCAT(id, level, nickname, first_name, last_name, email, phone, birthday, start_office_date, department, title)'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(10); 
				$rule=2;
				}
				elseif($bdata==2){
					$users = \DB::table('users')
									->where(\DB::raw('CONCAT(id, level, nickname, first_name, last_name, email, phone, birthday, start_office_date, department, title)'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(10); 
				$rule=1;
				}
			  }
		}
		return view('erp_user',['users'=>$users,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
		);
	}
	public function export_customer()
	{
		$result = \DB::table('customer_list')
									->orderBy('num','asc')
									->get();  
		$str = ""; 
		$str = mb_convert_encoding($str,"gb2312","utf-8"); 
		foreach($result as $data)
		{
			$num = mb_convert_encoding($data->num,"gb2312","utf-8"); 
			$name = $data->name;
			$first_name = $data->first_name;
			$last_name = $data->last_name;
			$company_name = $data->company_name; 
			$company_name_eng = $data->company_name_eng; 
			$title = $data->title;
			$department = $data->department;
			$address = $data->address;
			$phone = $data->phone; 
			$fax = $data->fax;
			$cellphone = $data->cellphone; 
			$email = $data->email; 
			$url = $data->url; 
			$type = $data->type;
			$tax_number = $data->tax_number; 
			$repeat_status = $data->repeat_status;
			$name_eng = $data->name_eng; 
			$title_eng = $data->title_eng; 
			$department_eng = $data->department_eng;
			$address_eng = $data->address_eng; 
			$remark = $data->remark;
			$kind = $data->kind; 
			$queue = $data->queue; 
			$specialization = $data->specialization; 
			$str .= $num.",".$name.",".$first_name.",".$last_name.",".$company_name.",".$company_name.",".$company_name_eng.",".$title.",".$department.",".$address.",".$phone.",".$fax.",".$cellphone.",".$email.",".$url.",".$type.",".$tax_number.",".$repeat_status.",".$name_eng.",".$title_eng.",".$department_eng.",".$address_eng.",".$remark.",".$kind.",".$queue.",".$specialization."\n";
		}
		$filename = date('Ymd').'.csv'; //設定檔名 
		function export_csv($filename,$str) 
		{ 
		header("Content-type:text/csv;charset=utf-8"); 
		header("Content-Disposition:attachment;filename=".$filename); 
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
		header('Expires:0'); 
		header('Pragma:public'); 
		echo $str; 
		}
		export_csv($filename,$str); //匯出 
		
	}
	
	public function export()
	{
		$result = \DB::table('device_list')
									->orderBy('num','asc')
									->get();  
		$str = ""; 
		$str = mb_convert_encoding($str,"gb2312","utf-8"); 
		foreach($result as $data)
		{
			$num = mb_convert_encoding($data->item,"gb2312","utf-8");
			$num = $data->num; 
			$item = $data->item;	
			$label = $data->label;
			$model = $data->model; 
			$quantity = $data->quantity; 
			$insert_date = $data->insert_date;
			$staff = $data->staff;
			$purpose = $data->purpose;
			$location = $data->location;
			$status = $data->status; 
			$remarks = $data->remarks; 
			$str .= $num.",".$item.",".$label.",".$model.",".$quantity.",".$insert_date.",".$staff.",".$purpose.",".$location.",".$status.",".$remarks."\n";
		}
		$filename = date('Ymd').'.csv'; //設定檔名 
		function export_csv($filename,$str) 
		{ 
		header("Content-type:text/csv;charset=utf-8"); 
		header("Content-Disposition:attachment;filename=".$filename); 
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
		header('Expires:0'); 
		header('Pragma:public'); 
		echo $str; 
		}
		export_csv($filename,$str); //匯出 
		
	}

	public function import_device(Request $request)
	{
	function input_csv($handle) 
	{ 
		$out = array (); 
		$n = 0; 
		while ($data = fgetcsv($handle, 10000)) 
		{ 
		$num = count($data); 
		for ($i=0;$i<$num;$i++) 
		{ 
		$out[$n][$i] = $data[$i]; 
		} 
		$n=$n+1; 
		} 
		return $out; 
	}
		$filename = $_FILES['file']['tmp_name']; 
		if(empty($filename)) 
		{ 
		echo '請選擇要匯入的CSV檔案！'; 
		exit; 
		} 
		$handle = fopen($filename, 'r'); 
		$result = input_csv($handle); //解析csv 
		$len_result = count($result); 
		if($len_result==0) 
		{ 
		echo '沒有任何資料！'; 
		exit; 
		} 
		$data_values="";
		for($i=0;$i<$len_result;$i++) //迴圈獲取各欄位值 
		
		{
			//$num = array('num'=>$result[$i][0]);
		 $data_values=array(
			'num' => $result[$i][0],
			'item' => $result[$i][1],
			'label' => $result[$i][2],
			'model' => $result[$i][3],
			'quantity' => $result[$i][4],
			'insert_date' => $result[$i][5],
			'staff' => $result[$i][6],
			'purpose' => $result[$i][7],
			'location' => $result[$i][8],
			'status' => $result[$i][9],
			'remarks' => $result[$i][10]
		 );
		 //$query = \DB::table('device_list')->insert($data_values);
		 $query=DeviceData::updateOrCreate(['num'=>$data_values['num']],$data_values);
		} 
		fclose($handle); //關閉指標 			
		//mysqli_query($_SESSION["link"],"insert into device_list (item,label,model,quantity,insert_date,staff,purpose,location,status,remarks) values $data_values"); //批量插入資料表中 
		//echo $query;
		if($query) 
		{ 
		echo '匯入成功！'; 
		}else{ 
		echo "{$query} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
		echo '匯入失敗！'; 
		} 
		 
	}
}
