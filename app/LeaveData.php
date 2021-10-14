<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveData extends Model
{  
    protected $table = 'leave_list';
    public $incrementing = false;
    protected $primaryKey = 'leave_num';
    protected $fillable = [
        'leave_num','id','name', 'title','take_office','type','reason','start_time','end_time','total','status'
    ];
}
