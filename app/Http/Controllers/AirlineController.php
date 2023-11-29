<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'airlines.';
    public function index()
    {
        $data = Airline::paginate(5);
        return view(self::VIEW_PATH . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);
        Airline::create($request->all());
        Alert::success('Successfully', 'Created successfully');
        return redirect()->route('airline.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('airline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);
        $airline->update($request->all());
        Alert::success('Successfully', 'Updated successfully');
        return redirect()->route('airline.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        $airline->delete();
        Alert::success('Successfully', 'Updated successfully');
        return back();
    }
}
