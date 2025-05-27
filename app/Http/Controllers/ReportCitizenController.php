<?php

namespace App\Http\Controllers;

use App\Mail\ReportMail;
use App\Models\Citizen;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportCitizenController extends Controller
{
    public function send_report(Request $request) {
        $user= $request->user();
        $email = $user->email;

        $city_count = City::count();
        $citizen_count = Citizen::count();
        $datos = 'Registros a reportar: ' . $citizen_count . ' ciudadanos y '. $city_count . ' ciudades';
        Mail::to($email)->send(new ReportMail($datos));
        return back()->with('success', 'Reporte enviado exitosamente');
    }
}
