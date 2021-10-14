<?php

namespace App\Http\Controllers;
use App\RepairData;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Mail; 

class RepairController extends Controller
{
    public function index()
    {
        return view('home');
	}
	public function export_repair_excel()  
	{
		return Excel::download(new OrderExport, date('Ymd').'repair.xlsx');
	}
	

    public function repair() 
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
			  $repairs = \DB::table('repair_list')->Paginate(15); 
			  $rule=1;
			  }
			  else{
				if($bdata==1){
					$repairs = \DB::table('repair_list')
									->orderBy($adata,'desc')
									->Paginate(15);
					$rule=0;
				}
				elseif($bdata==2){
					$repairs = \DB::table('repair_list')
									->orderBy($adata,'asc')
									->Paginate(15); 
					$rule=0;
				}
			  }
		}
		elseif($cdata!="0"){
			  if($adata==0&&$bdata==0){
				$repairs = \DB::table('repair_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`item`,""),IFNULL(`reason`,""),IFNULL(`status`,""),IFNULL(`applicant`,""),IFNULL(`remarks`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
									->Paginate(15);   
				$rule=1;
			  }
			  else{
				if($bdata==1){
					$repairs = \DB::table('repair_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`item`,""),IFNULL(`reason`,""),IFNULL(`status`,""),IFNULL(`applicant`,""),IFNULL(`remarks`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'desc')
									->Paginate(15); 
				$rule=0;
				}
				elseif($bdata==2){
					$repairs = \DB::table('repair_list')
									->where(\DB::raw('CONCAT(IFNULL(`num`,""), IFNULL(`item`,""),IFNULL(`reason`,""),IFNULL(`status`,""),IFNULL(`applicant`,""),IFNULL(`remarks`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
									->orderBy($adata,'asc')
									->Paginate(15); 
				$rule=1;
				}
			  }
		}
				
	return view('erp_repair',['repairs'=>$repairs,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
					);
	}

	public function add_repair(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
                'item' => $request->item,
                'reason' => $request->reason,
                'status' => $request->status,
                'applicant' => $request->applicant,
                'remarks' => $request->remarks,
           );
           $id=RepairData::create($data);
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

    public function edit_repair() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('repair_list')->where('num',$adata)->first();

        return view('erp_repair_edit',['datas'=>$results,'adata'=>$adata]
        );
    }

    public function update_repair(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
				'item' => $request->item,
				'reason' => $request->reason,
				'status' => $request->status,
				'applicant' => $request->applicant,
				'remarks' => $request->remarks,
				'created_at' => $request->created_at,    
           );
           $id=\DB::table('repair_list')
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

    public function export_repair()
	{
		$result = \DB::table('repair_list')
									->orderBy('num','asc')
									->get();  
		$str = ""; 
		$str = mb_convert_encoding($str,"gb2312","utf-8"); 
		foreach($result as $data)
		{
			$num = mb_convert_encoding($data->item,"gb2312","utf-8");
			$num = $data->num; 
			$item = $data->item;	
			$reason = $data->reason;
			$status = $data->status; 
			$applicant = $data->applicant;
			$remarks = $data->remarks; 
			$created_at = $data->created_at;
			$str .= "\"".$num."\",\"".$item."\",\"".$reason."\",\"".$status."\",\"".$applicant."\",\"".$remarks."\",\"".$created_at."\"\n";
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
	
	public function mail_test()
	{
		$data = ['title' => 'Test', 'name' => 'testuser'];
		Mail::send('email', $data, function($message) {
			$message->to('peter@simware.com.tw')->subject('This is a test email');
		   });
		   return 'The test email has been sent.';
	}
	public function download_test()
	{
		$file=public_path().'/download/ls-dyna_mpp_s_R90_winx64_ifort131_msmpi.zip';
		$filename='testfile.zip';
		$headers=[
			"Content-Disposition"=>"attachment; filename=".$filename,
			"Content-Transfer-Encoding"=>" binary",
			"Content-Type"=>" application/download"
			];
		return response()->download($file,$filename);
	}
}
