<?php

namespace App\Exports;
use App\Models\Citizen;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitizenExport implements FromCollection, WithMapping,WithHeadings
{
   public function collection()
    {
        return Citizen::with('city')->get();
    }

    public function map($citizen): array
    {
        return [
            $citizen->first_name,
            $citizen->last_name,
            $citizen->birth_date,
            $citizen->city->name,
            $citizen->address,
            $citizen->phone,
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Fecha de nacimiento',
            'Ciudad',
            'Dirección',
            'Teléfono'
        ];
    }
}
