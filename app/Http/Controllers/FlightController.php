<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'flights.';
    private const PUBLIC_PATH = 'flights';
    public function index()
    {
        $data = Flight::paginate(5);
        return view(self::VIEW_PATH . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $airlines = Airline::with('airline')->pluck('name', 'id')->toArray();
        return view(self::VIEW_PATH . __FUNCTION__, compact('airlines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'image' => 'image|file',
            'total_passengers' => 'numeric',
            'airline_id' => [
                Rule::exists('airlines', 'id')
            ]
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PUBLIC_PATH, $request->file('image'));
        }
        Flight::create($data);
        Alert::success('Successfully', 'Created successfully');
        return redirect()->route('flight.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        $airlines = Airline::with('airline')->pluck('name', 'id')->toArray();
        return view(self::VIEW_PATH . __FUNCTION__, compact('flight', 'airlines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $request->validate([
            'name' => 'required|max:50',
            'image' => 'image|file',
            'total_passengers' => 'numeric',
            'airline_id' => [
                Rule::exists('airlines', 'id')
            ]
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PUBLIC_PATH, $request->file('image'));
        }
        $currentImage = $flight->image;
        $flight->update($data);
        if ($request->hasFile('image') && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }
        Alert::success('Successfully', 'Updated successfully');
        return redirect()->route('flight.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        if (empty($flight->airline)) {
            $flight->delete();
            if ($flight->image && Storage::exists($flight->image)) {
                Storage::delete($flight->image);
            }
            Alert::success('Successfully', 'Deleted successfully');
            return back();
        }
        Alert::error('Failed', 'Deleted failed');
        return back();
    }
}
