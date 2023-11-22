@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Name"
                    value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="file" name="image" id="" class="form-control">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                Show ?? <br>
                <label for="status-1">
                    <input type="radio" name="is_show" id="status-1" value="0">
                    Hide
                </label>
                <label for="status-2">
                    <input type="radio" name="is_show" id="status-2" value="1">
                    Show
                </label>
                @error('status')
                    <span class="text-center">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('brand.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
