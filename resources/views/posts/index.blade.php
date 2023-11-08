@extends('layouts.app')
@section('app')
    <a href="{{ route('post.create') }}" class="btn btn-primary my-2">Create</a>
    @if ($data->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <img src="{{ Storage::url($item->image) }}" alt="" width="100px">
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('post.edit', $item) }}" class="btn btn-warning">Update</a> &nbsp;
                                <form action="{{ route('post.destroy', $item) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this')">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}
    @else
        <p class="text-center my-2">
            <a href="{{ route('post.create') }}" class="btn btn-primary">Create</a>
        </p>
    @endif
@endsection
