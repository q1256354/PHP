<?php

namespace App\Imports;
use App\CustomerData;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function model(array $row)
    {
        return new CustomerData([
            'num'=>$row[0],
            'name'=>$row[1],
            'first_name' =>$row[2],
            'last_name' =>$row[3],
            'company_name' =>$row[4],
            'company_name_eng' =>$row[5],
            'title' =>$row[6],
            'department' =>$row[7],
            'address' =>$row[8],
            'phone' =>$row[9],
            'fax' =>$row[10],
            'cellphone' =>$row[11],
            'email' =>$row[12],
            'url' =>$row[13],
            'type' =>$row[14],
            'tax_number' =>$row[15],
            'repeat_status' =>$row[16],
            'name_eng' =>$row[17],
            'title_eng' =>$row[18],
            'department_eng' =>$row[19],
            'address_eng' =>$row[20],
            'remark' =>$row[21],
            'kind' =>$row[22],
            'queue' =>$row[23],
            'specialization' =>$row[24],

        ]);
    }
}