<?php

namespace App\Exports;

use App\Models\Loyalty;
use Maatwebsite\Excel\Concerns\FromCollection;

class LoyaltyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Loyalty::all()->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    }
}
