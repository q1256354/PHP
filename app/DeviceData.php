<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{  
    protected $table = 'device_list';
    public $incrementing = false;
    protected $primaryKey = 'num';
    protected $fillable = [
        'num','item','label', 'model','quantity','insert_date','staff','purpose','location','status','remarks'
    ];
}
