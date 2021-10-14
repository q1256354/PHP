<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairData extends Model
{  
    protected $table = 'repair_list';
    public $incrementing = false;
    protected $primaryKey = 'num';
    protected $fillable = [
        'num','item','reason','status','applicant','remarks'
    ];
}
