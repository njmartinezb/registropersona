<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CitiesExport;
use Illuminate\Support\Facades\Response;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $cities = City::orderBy('name', 'asc')->paginate(6);
            return view('cities.index', compact('cities'));
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to fetch cities: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            City::create($request->all());

            return redirect()->route('cities.index')->with('success', 'City created successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create city: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
            $city = City::findOrFail($id);
            return view('cities.show', compact('city'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'City not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try{
            $city = City::findOrFail($id);
            return view('cities.edit', compact('city'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'City not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $city = City::findOrFail($id);
            $city->update($request->all());
            return redirect()->route('cities.index')->with('success', 'City updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update city: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $city = City::findOrFail($id);
            $city->delete();

            return redirect()->route('cities.index')->with('success', 'City deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete city: ' . $e->getMessage()], 500);
        }
    }

    # New Export Function
    public function export($format)
{
    # Get all data
    $cities = City::all();

    if ($format === 'csv') {
        # Setting file name and headers
        $filename = 'cities.csv'; 
        $headers = [
            'Content-Type' => 'text/csv', 
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($cities) {
            $file = fopen('php://output', 'w');
            # fputcsv function useful when the Data has an extra ','
            # Ex. 
            # Name -> Managua, Nicaragua
            # Description -> La Capital
            # Prevent the file from getting corrupted by extra spaces or ','
            fputcsv($file, ['Name', 'Description']); # Putting Headers File
            foreach ($cities as $city) {
                fputcsv($file, [$city->name, $city->description]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    } elseif ($format === 'xls') {
        return Excel::download(new CitiesExport, 'cities.xlsx');
    }

    return redirect()->route('cities.index')->with('error', 'Invalid export format.');
}



}
