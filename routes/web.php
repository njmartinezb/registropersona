<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\CitizenExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ReportCitizenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    # Export citizens route
    Route::get("/citizens-report/csv", [CitizenExportController::class, 'get_csv_report'])->name("export.csv");
    Route::get("/citizens-report/xlsx", [CitizenExportController::class, 'get_xlsx_report'])->name("export.xlsx");

    Route::get('/mail-report', [ReportCitizenController::class, 'send_report'])->name('mail-report.send');
    Route::resource('cities', CityController::class);
    Route::resource('citizens', CitizenController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

# Export cities route
Route::get('/cities/export/{format}', [CityController::class, 'export'])->name('cities.export');


require __DIR__.'/auth.php';
