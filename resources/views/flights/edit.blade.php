@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('flight.update', $flight) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Name"
                    value="{{ old('name') ?? $flight->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="file" name="image" id="" class="form-control">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div>
                    <img src="{{ Storage::url($flight->image) }}" alt="" width="120px">
                </div>
            </div>
            <div class="mb-3">
                <input type="text" name="total_passengers" id="" class="form-control"
                    placeholder="Total passengers" value="{{ $flight->total_passengers }}">
                @error('total_passengers')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <select name="airline_id" id="" class="form-control">
                    @foreach ($airlines as $i => $airline)
                        <option value="{{ $i }}" {{ $i === $flight->airline_id ? 'selected' : '' }}>
                            {{ $airline }}</option>
                    @endforeach
                </select>
                @error('airline_id')
                    <span class="text-center">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('flight.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
