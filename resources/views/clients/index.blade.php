@extends('layouts.app')
@section('app')
    <a href="{{ route('client.create') }}" class="btn btn-primary my-2">Create</a>
    @if ($data->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Company</th>
                    <th>Account</th>
                    <th>Project</th>
                    <th>Invoices</th>
                    <th>Tags</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->company_name }}</td>
                        <td><img src="{{ Storage::url($item->avatar) }}" alt="" width="30px">{{ $item->account }}
                        </td>
                        <td>{{ $item->project }}</td>
                        <td>{{ number_format($item->invoices) }}</td>
                        <td>{{ $item->tags }}</td>
                        <td><span class="btn btn-light">{{ $item->category }}</span></td>
                        <td><span class="btn btn-secondary">{{ $item->status }}</span></td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('client.edit', $item) }}" class="btn btn-warning">Update</a> &nbsp;
                                <a href="{{ route('client.show', $item) }}" class="btn btn-info">Show</a> &nbsp;
                                <form action="{{ route('client.destroy', $item) }}" method="post">
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
            <a href="{{ route('client.create') }}" class="btn btn-primary">Create</a>
        </p>
    @endif
@endsection
