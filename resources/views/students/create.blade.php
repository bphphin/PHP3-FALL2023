@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="std_id" id="" class="form-control" placeholder="Mã SV"
                    value="{{ old('std_id') }}">
                @error('std_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="class_name" id="" class="form-control" placeholder="Tên Lớp"
                    value="{{ old('class_name') }}">
                @error('class_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Tên SV"
                    value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="file" name="avatar" id="" class="form-control">
                @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('student.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
