<?php

namespace App\Http\Controllers;
use App\Exports\CitizenExport;
use Maatwebsite\Excel\Facades\Excel;

class CitizenExportController extends Controller
{
  public function get_xlsx_export()
    {
        return Excel::download(new CitizenExport, 'cuidadanos.xlsx');
    }

    public function get_csv_report() {
        return Excel::download(
            new CitizenExport,
            'reporte_cuidadanos.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
