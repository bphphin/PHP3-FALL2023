@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('car.update', $car) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Name"
                    value="{{ old('name') ?? $car->name }}">
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
                    <img src="{{ Storage::url($car->thumbnail) }}" alt="" width="120px">
                </div>
            </div>
            <div class="mb-3">
                <select name="brand_id" id="" class="form-control">
                    @foreach ($brands as $i => $brand)
                        <option value="{{ $i }}" {{ $i === $car->brand_id ? 'selected' : '' }}>
                            {{ $brand }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <span class="text-center">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('car.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
