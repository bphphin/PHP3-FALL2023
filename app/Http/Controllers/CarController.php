<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'cars.';
    private const PUBLIC_PATH = 'cars';
    public function index()
    {
        $data = Car::query()->with('brand')->paginate(5);
        return view(self::VIEW_PATH . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::query()->pluck('name', 'id')->toArray();
        return view(self::VIEW_PATH . __FUNCTION__, compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'thumbnail' => 'image|file',
            'brand_id' => [
                Rule::exists('brands', 'id')
            ]
        ]);
        $data = $request->except('thumbnail');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PUBLIC_PATH, $request->file('thumbnail'));
        }
        Car::create($data);
        Alert::success('Successfully', 'Created successfully');
        return redirect()->route('car.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $brands = Brand::query()->pluck('name', 'id')->toArray();
        return view(self::VIEW_PATH . __FUNCTION__, compact('brands', 'car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|max:50',
            'thumbnail' => 'image|file',
            'brand_id' => [
                Rule::exists('brands', 'id')
            ]
        ]);
        $data = $request->except('thumbnail');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PUBLIC_PATH, $request->file('thumbnail'));
        }
        $currentThumbnail = $car->thumbnail;
        if ($request->hasFile('thumbnail') && Storage::exists($currentThumbnail)) {
            Storage::delete($currentThumbnail);
        }
        $car->update($data);
        Alert::success('Successfully', 'Updated successfully');
        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        if ($car->thumbnail && Storage::exists($car->thumbnail)) {
            Storage::delete($car->thumbnail);
        }
        Alert::success('Successfully', 'Deleted successfully');
        return back();
    }
}
