<?php

namespace App\Exports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
# New Classes FromCollection and WithHeadings
class CitiesExport implements FromCollection, WithHeadings
{
    # Collection use Laravel Collections, such as Model:all()
    public function collection()
    {
        return City::select('name', 'description')->get();
    }

    # Document Headers
    public function headings(): array
    {
        return ['Name', 'Description'];
    }
}
