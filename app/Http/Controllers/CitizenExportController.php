<?php

namespace App\Http\Controllers;
use App\Exports\CitizenExport;
use Maatwebsite\Excel\Facades\Excel;

class CitizenExportController extends Controller
{
    //Here we use the excel facade defined in the citizens export class
  public function get_xlsx_export()
    {
        return Excel::download(new CitizenExport, 'cuidadanos.xlsx');
    }

    public function get_csv_report() {
        return Excel::download(
            new CitizenExport,
            'reporte_cuidadanos.csv',
            \Maatwebsite\Excel\Excel::CSV //we use this stereotype to reuse our data definition
        );
    }
}
