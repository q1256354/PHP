<?php

namespace App\Http\Controllers;
use App\DeviceData;
use Illuminate\Http\Request;
use App\Exports\DeviceExport;
use App\Imports\DeviceImport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class DeviceController extends Controller
{
    public function index()
    {
        return view('home');
	}
	public function export_device_excel()  
	{
		return Excel::download(new DeviceExport, date('Ymd').'device.xlsx');
	}
	public function import_device_excel(Request $request)  
	{
		$devices=Excel::toCollection(new DeviceImport(), $request->file('import_file'));
		foreach ($devices[0] as $device){
			$data_values=array([
				'num' => $device[0],
				'item' => $device[1],
				'label' => $device[2],
				'model' => $device[3],
				'quantity' => $device[4],
				'insert_date' => $device[5],
				'staff' => $device[6],
				'purpose' => $device[7],
				'location' => $device[8],
				'status' => $device[9],
				'remarks' => $device[10]
			]);
			//dd($data_values[0]);
			DeviceData::updateOrCreate(['num'=>$device['0']],$data_values[0]);
		}
		echo '匯入成功！'; 
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
					$rule=2;
				}
				elseif($bdata==2){
					$devices = \DB::table('device_list')
									->orderBy($adata,'asc')
									->Paginate(15); 
					$rule=1;
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$devices = \DB::table('device_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`item`,""),IFNULL(`label`,""),IFNULL(`model`,""),IFNULL(`quantity`,""),IFNULL(`insert_date`,""),IFNULL(`staff`,""),IFNULL(`purpose`,""),IFNULL(`location`,""),IFNULL(`status`,""),IFNULL(`remarks`,""))'), 'like',"%{$cdata}%")
									->Paginate(15);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$devices = \DB::table('device_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`item`,""),IFNULL(`label`,""),IFNULL(`model`,""),IFNULL(`quantity`,""),IFNULL(`insert_date`,""),IFNULL(`staff`,""),IFNULL(`purpose`,""),IFNULL(`location`,""),IFNULL(`status`,""),IFNULL(`remarks`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(15); 
				$rule=2;
				}
				elseif($bdata==2){
					$devices = \DB::table('device_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`item`,""),IFNULL(`label`,""),IFNULL(`model`,""),IFNULL(`quantity`,""),IFNULL(`insert_date`,""),IFNULL(`staff`,""),IFNULL(`purpose`,""),IFNULL(`location`,""),IFNULL(`status`,""),IFNULL(`remarks`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(15); 
				$rule=1;
				}
			  }
		}
				
	return view('erp_device',['devices'=>$devices,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
					);
	}

	public function add_device(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
                'item' => $request->item,
                'label' => $request->label,
                'model' => $request->model,
                'quantity' => $request->quantity,
                'insert_date' => $request->insert_date,
                'staff' => $request->staff,
                'purpose' => $request->purpose,
                'location' => $request->location,
                'status' => $request->status,
                'remarks' => $request->remarks,     
           );
           $id=DeviceData::create($data);
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

    public function edit_device() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('device_list')->where('num',$adata)->first();

        return view('erp_device_edit',['datas'=>$results,'adata'=>$adata]
        );
    }

    public function update_device(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
                'item' => $request->item,
                'label' => $request->label,
                'model' => $request->model,
                'quantity' => $request->quantity,
                'insert_date' => $request->insert_date,
                'staff' => $request->staff,
                'purpose' => $request->purpose,
                'location' => $request->location,
                'status' => $request->status,
                'remarks' => $request->remarks,     
           );
           $id=\DB::table('device_list')
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

    public function export_device()
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
			$str .= "\"".$num."\",\"".$item."\",\"".$label."\",\"".$model."\",\"".$quantity."\",\"".$insert_date."\",\"".$staff."\",\"".$purpose."\",\"".$location."\",\"".$status."\",\"".$remarks."\"\n";
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
