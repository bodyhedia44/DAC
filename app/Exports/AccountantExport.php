<?php

namespace App\Exports;

use App\Models\Accountant;
use Maatwebsite\Excel\Concerns\FromCollection;

class AccountantExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Accountant::all()->makeHidden(['created_at', 'updated_at']);
    }
}
