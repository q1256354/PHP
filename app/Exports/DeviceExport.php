<?php

namespace App\Exports;
use App\DeviceData;
use Maatwebsite\Excel\Concerns\FromCollection;

class DeviceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DeviceData::all();
    }
}
