<?php

namespace App\Http\Controllers;
use App\DeviceData;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index() 
	{
			
	}
	
	public function status() 
	{				
	
			$results = \DB::table('repair_list')
						->where('status','0')
						->count();								
		 return $results;
	//	 var_dump $results;
	}
	
	
}
