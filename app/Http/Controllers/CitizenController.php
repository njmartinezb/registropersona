<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Citizen;
use Illuminate\Http\Request;

class CitizenController extends Controller
{

    public function index()
    {
        //
        try{
            $citizens = Citizen::orderBy('first_name', 'asc')->paginate(6);
        $cities = City::all();
            return view('citizens.index',['citizens' => $citizens, 'cities' => $cities]);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to fetch citizens: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('citizens.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                'first_name' => 'required|string|max:60',
                'last_name' =>  'required|string|max:60',
                'birth_date' => 'required|date',
                'city_id' => 'required|exists:cities,id',
                'address' => 'nullable|string|max:1000',
                'phone' => 'nullable|string|max:15',
            ]);

            Citizen::create($request->all());

            return redirect()->route('citizen.index')->with('success', 'City created successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create citizen: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
            $citizen = Citizen::findOrFail($id);
            return view('citizen.show', compact('citizen'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Citizen not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $citizen = City::findOrFail($id);
            return view('citizen.edit', compact('citizen'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Citizen not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'first_name' => 'required|string|max:60',
                'last_name' =>  'required|string|max:60',
                'birth_date' => 'required|date',
                'city_id' => 'required|exists:cities,id',
                'address' => 'nullable|string|max:1000',
                'phone' => 'nullable|string|max:15',
            ]);


            $citizen = City::findOrFail($id);
            $citizen->update($request->all());
            return redirect()->route('citizens.index')->with('success', 'Citizen updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update citizen: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $citizen = Citizen::findOrFail($id);
            $citizen->delete();
            return redirect()->route('citizens.index')->with('success', 'citizen deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete citizen: ' . $e->getMessage()], 500);
        }
    }
}
