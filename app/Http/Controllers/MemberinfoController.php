<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class MemberinfoController extends Controller
{
    public function index()
    {
        return view('home');
    }

	public function member_info() 
	{
        $user = Auth::user();
        //年齡計算--------------
        $now=Carbon::today();
        $birthday=$user->birthday;
        $byear=date('Y',strtotime($birthday));
        $bmonth=date('m',strtotime($birthday));
        $bday=date('d',strtotime($birthday));
        //格式化當前時間年月日
        $tyear=date('Y');
        $tmonth=date('m');
        $tday=date('d');
        //開始計算年齡
        $age=$tyear-$byear;
        if($bmonth>$tmonth || $bmonth==$tmonth && $bday>$tday){
        $age--;  
        }
        //年齡計算--------------
       return view('memberinfo',['user'=>$user,'age'=>$age]);
    }
	
    public function edit_member() 
	{
        $adata = $_GET['i'];
        $results=\DB::table('users')->where('id',$adata)->first();

        return view('erp_member_edit',['datas'=>$results,'adata'=>$adata]
        );
    }

    public function update_member(Request $request) 
	{
       if($request->ajax())
       {
           $data=array(
               // 'id' => $request->id,
                'level' => $request->level,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'nickname' => $request->nickname,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'start_office_date'=>$request->start_office_date,
                'department' => $request->department,
                'title' => $request->title              
           );
           $id=\DB::table('users')
                    ->where('id',$request->id)
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
    
}
