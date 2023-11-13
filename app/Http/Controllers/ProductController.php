<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const VIEW_PATH = 'products.';
    private const PUBLIC_PATH = 'products';

    public function index()
    {
        $data = Product::latest()->paginate(5);
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
            'thumbnail' => 'image|file',
            'name' => 'required',
            'price' => 'required',
            'status' => [
                'required',
                Rule::in([
                    Product::STATUS_DRAFF,
                    Product::STATUS_PUBLISHED,
                ]),
            ],
        ]);
        $data = $request->except('thumbnail');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PUBLIC_PATH, $request->file('thumbnail'));
        }
        Product::create($data);
        Alert::success('Successfully', 'Created Student Successfully');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'thumbnail' => 'image|file',
            'name' => 'required',
            'price' => 'required',
            'status' => [
                'required',
                Rule::in([
                    Product::STATUS_DRAFF,
                    Product::STATUS_PUBLISHED,
                ]),
            ],
        ]);
        $data = $request->except('thumbnail');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PUBLIC_PATH, $request->file('thumbnail'));
        }
        $currentThumbnail = $product->thumbnail;
        $product->update($data);
        if ($request->hasFile('thumbnail')) {
            Storage::delete($currentThumbnail);
        }
        Alert::success('Successfully', 'Updated Student Successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Storage::exists($product->thumbnail)) {
            Storage::delete($product->thumbnail);
        }
        $product->delete();
        Alert::success('Successfully', 'Deleted Student Successfully');
        return redirect()->route('product.index');
    }
}
