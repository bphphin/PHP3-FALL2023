@extends('layouts.app')
@section('app')
    <a href="{{ route('student.create') }}" class="btn btn-primary my-2">Create</a>
    @if ($data->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Sinh Viên</th>
                    <th>Tên Lớp</th>
                    <th>Họ Tên</th>
                    <th>Avatar</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->std_id }}</td>
                        <td>{{ $item->class_name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <img src="{{ Storage::url($item->avatar) }}" alt="" width="100px">
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('student.edit', $item) }}" class="btn btn-warning">Update</a> &nbsp;
                                <a href="{{ route('student.show', $item) }}" class="btn btn-warning">Show</a> &nbsp;
                                <form action="{{ route('student.destroy', $item) }}" method="post">
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
            <a href="{{ route('student.create') }}" class="btn btn-primary">Create</a>
        </p>
    @endif
@endsection
