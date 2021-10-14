<?php

namespace App\Http\Controllers;
use App\ShipmentData;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function shipment() 
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
			  $shipments = \DB::table('shipment_list')->Paginate(15); 
			  $rule=1;
			  }
			  else{
				if($bdata==1){
					$shipments = \DB::table('shipment_list')
									->orderBy($adata,'desc')
									->Paginate(15);
					$rule=0;
				}
				elseif($bdata==2){
					$shipments = \DB::table('shipment_list')
									->orderBy($adata,'asc')
									->Paginate(15); 
					$rule=0;
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$shipments = \DB::table('shipment_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`shipment_num`,""),IFNULL(`company`,""),IFNULL(`case_num`,""),IFNULL(`contact`,""),IFNULL(`address`,""),IFNULL(`item`,""),IFNULL(`quantity`,""),IFNULL(`remarks`,""))'), 'like',"%{$cdata}%")
									->Paginate(15);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$shipments = \DB::table('shipment_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`shipment_num`,""),IFNULL(`company`,""),IFNULL(`case_num`,""),IFNULL(`contact`,""),IFNULL(`address`,""),IFNULL(`item`,""),IFNULL(`quantity`,""),IFNULL(`remarks`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(15); 
				$rule=0;
				}
				elseif($bdata==2){
					$shipments = \DB::table('shipment_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`shipment_num`,""),IFNULL(`company`,""),IFNULL(`case_num`,""),IFNULL(`contact`,""),IFNULL(`address`,""),IFNULL(`item`,""),IFNULL(`quantity`,""),IFNULL(`remarks`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(15); 
				$rule=1;
				}
			  }
		}
				
	return view('erp_shipment',['shipments'=>$shipments,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
					);
	}

	public function add_shipment(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
                'shipment_num' => $request->shipment_num,
                'company' => $request->company,
                'case_num' => $request->case_num,
                'contact' => $request->contact,
                'address' => $request->address,
                'item' => $request->item,
                'quantity' => $request->quantity,
                'remarks' => $request->remarks,     
           );
           $id=ShipmentData::create($data);
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

    public function edit_shipment() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('shipment_list')->where('num',$adata)->first();

        return view('erp_shipment_edit',['datas'=>$results,'adata'=>$adata]
        );
	}
	public function print_shipment() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('shipment_list')->where('num',$adata)->first();

        return view('erp_shipment_print',['datas'=>$results,'adata'=>$adata]
        );
    }

    public function update_shipment(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
				'shipment_num' => $request->shipment_num,
				'company' => $request->company,
				'case_num' => $request->case_num,
				'contact' => $request->contact,
				'address' => $request->address,
				'item' => $request->item,
				'quantity' => $request->quantity,
				'remarks' => $request->remarks,
           );
           $id=\DB::table('shipment_list')
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

    public function export_shipment()
	{
		$result = \DB::table('shipment_list')
									->orderBy('num','asc')
									->get();  
		$str = ""; 
		$str = mb_convert_encoding($str,"gb2312","utf-8"); 
		foreach($result as $data)
		{
			$num = mb_convert_encoding($data->item,"gb2312","utf-8");
			$num = $data->num; 
			$shipment_num = $data->shipment_num;	
			$company = $data->company;
			$case_num = $data->case_num; 
			$contact = $data->contact; 
			$address = $data->address;
			$item = $data->item;
			$quantity = $data->quantity;
			$remarks = $data->remarks; 
			$str .= "\"".$num."\",\"".$shipment_num."\",\"".$company."\",\"".$case_num."\",\"".$contact."\",\"".$address."\",\"".$item."\",\"".$quantity."\",\"".$remarks."\"\n";
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
    
    public function import_shipment(Request $request)
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
			'shipment_num' => $result[$i][1],
			'company' => $result[$i][2],
			'case_num' => $result[$i][3],
			'contact' => $result[$i][4],
			'address' => $result[$i][5],
			'item' => $result[$i][6],
			'quantity' => $result[$i][7],
			'remarks' => $result[$i][8]
		 );
		 //$query = \DB::table('shipment_list')->insert($data_values);
		 $query=shipmentData::updateOrCreate(['num'=>$data_values['num']],$data_values);
		} 
		fclose($handle); //關閉指標 			
		//mysqli_query($_SESSION["link"],"insert into shipment_list (item,label,model,quantity,insert_date,staff,purpose,location,status,remarks) values $data_values"); //批量插入資料表中 
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
