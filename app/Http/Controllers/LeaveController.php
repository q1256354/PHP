<?php

namespace App\Http\Controllers;
use App\LeaveData;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function leave() 
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
		$user=Auth::user();
		$level=$user->level;
		$id=$user->id;
		if($level>=5){ //權限LEVEL>=5
			if($cdata=="0"){
				if($adata==0&&$bdata==0){
				$leaves = \DB::table('leave_list')->Paginate(15); 
				$rule=1;
				}
				else{
					if($bdata==1){
						$leaves = \DB::table('leave_list')
										->orderBy($adata,'desc')
										->Paginate(15);
						$rule=2;
					}
					elseif($bdata==2){
						$leaves = \DB::table('leave_list')
										->orderBy($adata,'asc')
										->Paginate(15); 
						$rule=1;
					}
				}
			}
			elseif($cdata!="0"){
				if($adata==0&&$bdata==0){
					$leaves = \DB::table('leave_list')
										->where(\DB::raw('CONCAT(IFNULL(`leave_num`,""),IFNULL(`id`,"") ,IFNULL(`name`,""),IFNULL(`title`,""),IFNULL(`take_office`,""),IFNULL(`reason`,""),IFNULL(`type`,""),IFNULL(`start_time`,""),IFNULL(`end_time`,""),IFNULL(`total`,""),IFNULL(`status`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
										->Paginate(15);   
					$rule=1;
				}
				else{
					if($bdata==1){
						$leaves = \DB::table('leave_list')
										->where(\DB::raw('CONCAT(IFNULL(`leave_num`,""),IFNULL(`id`,"") ,IFNULL(`name`,""),IFNULL(`title`,""),IFNULL(`take_office`,""),IFNULL(`reason`,""),IFNULL(`type`,""),IFNULL(`start_time`,""),IFNULL(`end_time`,""),IFNULL(`total`,""),IFNULL(`status`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
										->orderBy($adata,'desc')
										->Paginate(15); 
					$rule=2;
					}
					elseif($bdata==2){
						$leaves = \DB::table('leave_list')
										->where(\DB::raw('CONCAT(IFNULL(`leave_num`,""),IFNULL(`id`,"") ,IFNULL(`name`,""),IFNULL(`title`,""),IFNULL(`take_office`,""),IFNULL(`reason`,""),IFNULL(`type`,""),IFNULL(`start_time`,""),IFNULL(`end_time`,""),IFNULL(`total`,""),IFNULL(`status`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
										->orderBy($adata,'asc')
										->Paginate(15); 
					$rule=1;
					}
				}
			}
		}
		else{ //權限LEVEL<5
			if($cdata=="0"){
				if($adata==0&&$bdata==0){
				$leaves = \DB::table('leave_list')->where('id',$id)->Paginate(15); 
				$rule=1;
				}
				else{
					if($bdata==1){
						$leaves = \DB::table('leave_list')
										->where('id',$id)
										->orderBy($adata,'desc')
										->Paginate(15);
						$rule=2;
					}
					elseif($bdata==2){
						$leaves = \DB::table('leave_list')
										->where('id',$id)
										->orderBy($adata,'asc')
										->Paginate(15); 
						$rule=1;
					}
				}
			}
			elseif($cdata!="0"){
				if($adata==0&&$bdata==0){
					$leaves = \DB::table('leave_list')
										->where('id',$id)
										->where(\DB::raw('CONCAT(IFNULL(`leave_num`,""),IFNULL(`id`,"") ,IFNULL(`name`,""),IFNULL(`title`,""),IFNULL(`take_office`,""),IFNULL(`reason`,""),IFNULL(`type`,""),IFNULL(`start_time`,""),IFNULL(`end_time`,""),IFNULL(`total`,""),IFNULL(`status`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
										->Paginate(15);   
					$rule=1;
				}
				else{
					if($bdata==1){
						$leaves = \DB::table('leave_list')
										->where('id',$id)
										->where(\DB::raw('CONCAT(IFNULL(`leave_num`,""),IFNULL(`id`,"") ,IFNULL(`name`,""),IFNULL(`title`,""),IFNULL(`take_office`,""),IFNULL(`reason`,""),IFNULL(`type`,""),IFNULL(`start_time`,""),IFNULL(`end_time`,""),IFNULL(`total`,""),IFNULL(`status`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
										->orderBy($adata,'desc')
										->Paginate(15); 
					$rule=2;
					}
					elseif($bdata==2){
						$leaves = \DB::table('leave_list')
										->where('id',$id)
										->where(\DB::raw('CONCAT(IFNULL(`leave_num`,""),IFNULL(`id`,"") ,IFNULL(`name`,""),IFNULL(`title`,""),IFNULL(`take_office`,""),IFNULL(`reason`,""),IFNULL(`type`,""),IFNULL(`start_time`,""),IFNULL(`end_time`,""),IFNULL(`total`,""),IFNULL(`status`,""),IFNULL(`created_at`,""))'), 'like',"%{$cdata}%")
										->orderBy($adata,'asc')
										->Paginate(15); 
					$rule=1;
					}
				}
			}
		}
				
	return view('erp_leave',['leaves'=>$leaves,'search'=>$cdata,'sort'=>$adata,'rule'=>$rule]
					);
	}

	public function add_leave(Request $request) 
	{
		$validator=Validator::make($request->all(),[
			'type' => 'required',
			'total' => 'required',
		]);

       //if($request->ajax())
		if($validator->passes())
	   {
           $data=array(
                'id' => $request->id,
                'name' => $request->name,
                'title' => $request->title,
				'take_office' => $request->take_office,
				'type' => $request->type,
                'reason' => $request->reason,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'total' => $request->total,
                'status' => $request->status, 
           );
           $id=LeaveData::create($data);
           if($id)
           {
            return 'ok';
           }
           else{
            return 'wrong';
          }
       }
       else{
		   return response()->json(['error'=>$validator->errors()->all()]);
         //  return 'wrong';
       }
    }

    public function edit_leave() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('leave_list')->where('leave_num',$adata)->first();

        return view('erp_leave_edit',['datas'=>$results,'adata'=>$adata]
        );
	}
	
	public function review_leave(Request $request) 
	{
       if($request->ajax())
       {
       
         /*  $id=\DB::table('leave_list')
                    ->where('leave_num',$request->num)
					->update(['status'=>$request->status]);*/
		$leave=LeaveData::find($request->num);
		$leave->status=$request->status;
		$id=$leave->save();
           if($id)
           {
            return 'ok';
           }
       }
       else{
           return 'wrong';
       }
    }

    public function update_leave(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(	
				'type' => $request->type,
				'reason' => $request->reason,
				'start_time' => $request->start_time,
				'end_time' => $request->end_time,
				'total' => $request->total,
           );
          /* $id=\DB::table('leave_list')
                    ->where('leave_num',$request->num)
					->update($data);*/
			$id=LeaveData::find($request->num)->update($data);
		//	$id ->save();
           if($id>0)
           {
            return 'ok';
		   }
       }
       else{
           return 'wrong';
       }
    }

    public function export_leave()
	{
		$result = \DB::table('leave_list')
									->orderBy('leave_num','asc')
									->get();  
		$str = ""; 
		$str = mb_convert_encoding($str,"gb2312","utf-8"); 
		foreach($result as $data)
		{
			$leave_num = mb_convert_encoding($data->leave_num,"gb2312","utf-8");
			$leave_num = $data->leave_num; 
			$name = $data->name;	
			$title = $data->title;
			$take_office = $data->take_office; 
			$type = $data->type; 
			$reason = $data->reason;
			$start_time = $data->start_time;
			$end_time = $data->end_time;
			$total = $data->total;
			$status = $data->status; 
			$created_at = $data->created_at; 
			$updated_at = $data->updated_at; 
			$str .= "\"".$leave_num."\",\"".$name."\",\"".$title."\",\"".$take_office."\",\"".$type."\",\"".$reason."\",\"".$start_time."\",\"".$end_time."\",\"".$total."\",\"".$status."\",\"".$created_at."\",\"".$updated_at."\"\n";
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
	protected function validator(array $data)
    {
        return Validator::make($data, [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'phone' => 'required|string|max:255',
			'birthday' => 'required|date',
			'department' => 'required|string|alpha_num|max:255',
			'title' => 'required|string|alpha_num|max:255',
			'account' => array(
							'required',
							'string',
							'max:255',
							'min:8',
							'max:16',
							'unique:users',
							'regex:/^[a-zA-Z][a-zA-Z0-9_]{8,16}$/',
							),
            'nickname' => 'required|alpha_num|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => array(
							'required',
							'string',
							'min:8',
							'max:16',
							'confirmed',
							'regex:/^(?!.*[^a-zA-Z0-9])(?=.*\d)(?=.*[a-zA-Z]).{8,16}$/',
							),
        ]);
    }

}
