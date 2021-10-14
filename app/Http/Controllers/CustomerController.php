<?php

namespace App\Http\Controllers;
use App\CustomerData;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index()
    {
        return view('home');
	}
	public function import_customer_excel(Request $request)  
	{
		$customers=Excel::toCollection(new CustomerImport(), $request->file('import_file'));
		foreach ($customers[0] as $customer){
			$data_values=array([
				'num' => $customer[0],
				'name'=>$customer[1],
				'first_name' =>$customer[2],
				'last_name' =>$customer[3],
				'company_name' =>$customer[4],
				'company_name_eng' =>$customer[5],
				'title' =>$customer[6],
				'department' =>$customer[7],
				'address' =>$customer[8],
				'phone' =>$customer[9],
				'fax' =>$customer[10],
				'cellphone' =>$customer[11],
				'email' =>$customer[12],
				'url' =>$customer[13],
				'type' =>$customer[14],
				'tax_number' =>$customer[15],
				'repeat_status' =>$customer[16],
				'name_eng' =>$customer[17],
				'title_eng' =>$customer[18],
				'department_eng' =>$customer[19],
				'address_eng' =>$customer[20],
				'remark' =>$customer[21],
				'kind' =>$customer[22],
				'queue' =>$customer[23],
				'specialization' =>$customer[24],
			]);
			//dd($data_values[0]);
			CustomerData::updateOrCreate(['num'=>$customer['0']],$data_values[0]);
		}
		echo '匯入成功！'; 
	}
	public function export_customer_excel()  
	{
		return Excel::download(new CustomerExport, date('Ymd').'customer.xlsx');
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
					$rule=2;
				}
				elseif($bdata==2){
					$customers = \DB::table('customer_list')
									->orderBy($adata,'asc')
									->Paginate(10); 
					$rule=1;
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$customers = \DB::table('customer_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""),IFNULL(`name`,""),IFNULL(`first_name`,""),IFNULL(`last_name`,""),IFNULL(`company_name`,""),IFNULL(`company_name_eng`,""),IFNULL(`title`,""),IFNULL(`department`,""),IFNULL(`address`,""),IFNULL(`phone`,""),IFNULL(`fax`,""),IFNULL(`cellphone`,""),IFNULL(`email`,""),IFNULL(`url`,""),IFNULL(`type`,""),IFNULL(`tax_number`,""),IFNULL(`repeat_status`,""),IFNULL(`name_eng`,""),IFNULL(`title_eng`,""),IFNULL(`department_eng`,""),IFNULL(`address_eng`,""),IFNULL(`remark`,""),IFNULL(`kind`,""),IFNULL(`queue`,""),IFNULL(`specialization`,""))'), 'like',"%{$cdata}%")
									->Paginate(10);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$customers = \DB::table('customer_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""),IFNULL(`name`,""),IFNULL(`first_name`,""),IFNULL(`last_name`,""),IFNULL(`company_name`,""),IFNULL(`company_name_eng`,""),IFNULL(`title`,""),IFNULL(`department`,""),IFNULL(`address`,""),IFNULL(`phone`,""),IFNULL(`fax`,""),IFNULL(`cellphone`,""),IFNULL(`email`,""),IFNULL(`url`,""),IFNULL(`type`,""),IFNULL(`tax_number`,""),IFNULL(`repeat_status`,""),IFNULL(`name_eng`,""),IFNULL(`title_eng`,""),IFNULL(`department_eng`,""),IFNULL(`address_eng`,""),IFNULL(`remark`,""),IFNULL(`kind`,""),IFNULL(`queue`,""),IFNULL(`specialization`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(10); 
				$rule=2;
				}
				elseif($bdata==2){
					$customers = \DB::table('customer_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""),IFNULL(`name`,""),IFNULL(`first_name`,""),IFNULL(`last_name`,""),IFNULL(`company_name`,""),IFNULL(`company_name_eng`,""),IFNULL(`title`,""),IFNULL(`department`,""),IFNULL(`address`,""),IFNULL(`phone`,""),IFNULL(`fax`,""),IFNULL(`cellphone`,""),IFNULL(`email`,""),IFNULL(`url`,""),IFNULL(`type`,""),IFNULL(`tax_number`,""),IFNULL(`repeat_status`,""),IFNULL(`name_eng`,""),IFNULL(`title_eng`,""),IFNULL(`department_eng`,""),IFNULL(`address_eng`,""),IFNULL(`remark`,""),IFNULL(`kind`,""),IFNULL(`queue`,""),IFNULL(`specialization`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(10); 
				$rule=1;
				}
			  }
		}
		return view('erp_customer',['customers'=>$customers,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
		);
	}

	public function add_customer(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(            
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'company_name_eng' => $request->company_name_eng,
                'title' => $request->title,
                'department' => $request->department,
                'address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'cellphone' => $request->cellphone,
                'email' => $request->email,
                'url' => $request->url,
                'type' => $request->type,
                'tax_number' => $request->tax_number,
                'repeat_status' => $request->repeat_status,
                'name_eng' => $request->name_eng,
                'title_eng' => $request->title_eng,
                'department_eng' => $request->department_eng,
                'address_eng' => $request->address_eng, 
                'remark' => $request->remark,
                'kind' => $request->kind,
                'queue' => $request->queue,
                'specialization' => $request->specialization,   
           );
		   $id=CustomerData::create($data);
           if($id)
           {
            return 'ok';
		   }
		   else{
           		return 'wrong';
        	}
       }
       else{
           return 'wrong';
       }
    }

    public function edit_customer() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('customer_list')->where('num',$adata)->first();

        return view('erp_customer_edit',['datas'=>$results,'adata'=>$adata]
        );
    }

    public function update_customer(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
                //'num' => $request->num,
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'company_name_eng' => $request->company_name_eng,
                'title' => $request->title,
                'department' => $request->department,
                'address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'cellphone' => $request->cellphone,
                'email' => $request->email,
                'url' => $request->url,
                'type' => $request->type,
                'tax_number' => $request->tax_number,
                'repeat_status' => $request->repeat_status,
                'name_eng' => $request->name_eng,
                'title_eng' => $request->title_eng,
                'department_eng' => $request->department_eng,
                'address_eng' => $request->address_eng, 
                'remark' => $request->remark,
                'kind' => $request->kind,
                'queue' => $request->queue,
                'specialization' => $request->specialization,    
           );
           $id=\DB::table('customer_list')
                    ->where('num',$request->num)
                    ->update($data);
           if($id>0)
           {
            return 'ok';
           }
       }
       else{
           return 'wrong';
       }
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
			$str .= "\"".$num."\",\"".$name."\",\"".$first_name."\",\"".$last_name."\",\"".$company_name."\",\"".$company_name_eng."\",\"".$title."\",\"".$department."\",\"".$address."\",\"".$phone."\",\"".$fax."\",\"".$cellphone."\",\"".$email."\",\"".$url."\",\"".$type."\",\"".$tax_number."\",\"".$repeat_status."\",\"".$name_eng."\",\"".$title_eng."\",\"".$department_eng."\",\"".$address_eng."\",\"".$remark."\",\"".$kind."\",\"".$queue."\",\"".$specialization."\"\n";
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
    
    public function import_customer(Request $request)
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
			'name' => $result[$i][1], 
            'first_name' => $result[$i][2],
            'last_name' => $result[$i][3],
            'company_name' => $result[$i][4],
            'company_name_eng' => $result[$i][5],
            'title' => $result[$i][6],
            'department' => $result[$i][7],
            'address' => $result[$i][8],
            'phone' => $result[$i][9],
            'fax' =>  $result[$i][10],
            'cellphone' => $result[$i][11],
            'email' => $result[$i][12],
            'url' => $result[$i][13],
            'type' => $result[$i][14],
            'tax_number' => $result[$i][15],
            'repeat_status' => $result[$i][16],
            'name_eng' =>  $result[$i][17],
            'title_eng' => $result[$i][18],
            'department_eng' => $result[$i][19],
            'address_eng' =>  $result[$i][20],
            'remark' =>  $result[$i][21],
            'kind' =>  $result[$i][22],
            'queue' =>  $result[$i][23],
            'specialization' => $result[$i][24]
		 );
		 //$query = \DB::table('device_list')->insert($data_values);
		 $query=CustomerData::updateOrCreate(['num'=>$data_values['num']],$data_values);
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
