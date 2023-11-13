@extends('layouts.app')
@section('app')
    <a href="{{ route('product.create') }}" class="btn btn-primary my-2">Create</a>
    @if ($data->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <img src="{{ Storage::url($item->thumbnail) }}" alt="" width="100px">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price) }} {{ number_format($item->sales_price) }} </td>
                        <td>{{ $item->status === \App\Models\Product::STATUS_PUBLISHED ? 'Active' : 'InActive' }}</td>
                        <td>{{ \Carbon\Carbon::now()->year - \Carbon\Carbon::parse($item->created_at)->format('Y') . ' Year Ago' }}
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('product.edit', $item) }}" class="btn btn-warning">Update</a> &nbsp;
                                <form action="{{ route('product.destroy', $item) }}" method="post">
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
            <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
        </p>
    @endif
@endsection
