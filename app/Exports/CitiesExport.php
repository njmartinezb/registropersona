<?php

namespace App\Exports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitiesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return City::select('name', 'description')->get();
    }

    public function headings(): array
    {
        return ['Name', 'Description'];
    }
}
