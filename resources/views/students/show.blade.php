@extends('layouts.app')
@section('app')
    <p>Mã Sinh Viên: {{ $student->std_id }}</p>
    <p>Tên Lớp: {{ $student->class_name }}</p>
    <p>Họ Tên: {{ $student->name }}</p>
    <p>Avatar:
        <img src="{{ Storage::url($student->avatar) }}" alt="" width="200px">
    </p>
@endsection
