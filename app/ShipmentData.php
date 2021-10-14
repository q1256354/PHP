<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentData extends Model
{  
    protected $table = 'shipment_list';
    public $incrementing = false;
    protected $primaryKey = 'num';
    protected $fillable = [
        'num','shipment_num','company', 'case_num','contact','address','item','quantity','staff','remarks'
    ];
}
