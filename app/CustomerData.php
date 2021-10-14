<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerData extends Model
{  
    protected $table = 'customer_list';
    public $incrementing = false;
    protected $primaryKey = 'num';
    protected $fillable = [
        'num','name','first_name','last_name','company_name','company_name_eng','title','department','address',
        'phone','fax','cellphone','email','url','type','tax_number','repeat_status','name_eng','title_eng',
        'department_eng','address_eng','remark','kind','queue','specialization'
    ];
}
