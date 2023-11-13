@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Title"
                    value="{{ old('name') ?? $product->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="file" name="thumbnail" id="" class="form-control">
                @error('thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div>
                    <img src="{{ Storage::url($product->thumbnail) }}" alt="" width="120px">
                </div>
            </div>

            <div class="mb-3">
                <input type="text" name="price" id="" class="form-control" placeholder="Price"
                    value="{{ old('price') ?? $product->price }}">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="sales_price" id="" class="form-control" placeholder="Sales"
                    value="{{ old('sales_price') ?? $product->sales_price }}">
                @error('sales_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status-1">
                    <input type="radio" name="status" id="status-1" value="{{ \App\Models\Product::STATUS_DRAFF }}"
                        {{ \App\Models\Product::STATUS_DRAFF === $product->status ? 'checked' : '' }}>
                    {{ \App\Models\Product::STATUS_DRAFF }}
                </label>
                <label for="status-2">
                    <input type="radio" name="status" id="status-2" value="{{ \App\Models\Post::STATUS_PUBLISHED }}"
                        {{ \App\Models\Product::STATUS_PUBLISHED === $product->status ? 'checked' : '' }}>
                    {{ \App\Models\Product::STATUS_PUBLISHED }}
                </label>
                @error('status')
                    <span class="text-center">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('product.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
