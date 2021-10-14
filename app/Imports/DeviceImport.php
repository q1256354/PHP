<?php

namespace App\Imports;
use App\DeviceData;
use Maatwebsite\Excel\Concerns\ToModel;

class DeviceImport implements ToModel
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function model(array $row)
    {
        return new DeviceData([
            'num'=>$row[0],
            'item'=>$row[1],
            'label'=>$row[2],
            'model'=>$row[3],
            'quantity'=>$row[4],
            'insert_date'=>$row[5],
            'staff'=>$row[6],
            'purpose'=>$row[7],
            'location'=>$row[8],
            'status'=>$row[9],
            'remarks'=>$row[10],

        ]);
    }
}