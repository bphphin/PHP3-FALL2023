@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('airline.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Name"
                    value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('airline.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
