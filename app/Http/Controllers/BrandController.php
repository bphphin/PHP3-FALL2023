<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'brands.';
    private const PUBLIC_PATH = 'brands';
    public function index()
    {
        $data = Brand::paginate(5);
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
            'name' => 'required|max:50|unique:brands',
            'image' => 'image|file',
            'is_show' => [
                Rule::in([0, 1])
            ]
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PUBLIC_PATH, $request->file('image'));
        }
        Brand::create($data);
        Alert::success('Successfully', 'Created successfully');
        return redirect()->route('brand.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|max:50|unique:brands,name,' . $brand->id,
            'image' => 'image|file',
            'is_show' => [
                Rule::in([0, 1])
            ]
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PUBLIC_PATH, $request->file('image'));
        }
        $currentImage = $brand->image;
        if ($request->hasFile('image') && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }
        $brand->update($data);
        Alert::success('Successfully', 'Updated successfully');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        if (Storage::exists($brand->image)) {
            Storage::delete($brand->image);
        }
        Alert::success('Successfully', 'Deleted successfully');
        return back();
    }
}
