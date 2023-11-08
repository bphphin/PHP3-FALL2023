@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="title" id="" class="form-control" placeholder="Title"
                    value="{{ old('title') }}">
                @error('title')
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
                <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Content">{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status-1">
                    <input type="radio" name="status" id="status-1" value="{{ \App\Models\Post::STATUS_DRAFF }}">
                    {{ \App\Models\Post::STATUS_DRAFF }}
                </label>
                <label for="status-2">
                    <input type="radio" name="status" id="status-2" value="{{ \App\Models\Post::STATUS_PUBLISHED }}">
                    {{ \App\Models\Post::STATUS_PUBLISHED }}
                </label>
                @error('status')
                    <span class="text-center">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('post.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
