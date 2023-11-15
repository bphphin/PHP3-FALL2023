@extends('layouts.app')
@section('app')
    <div class="container">
        <p>Company: {{ $client->company_name ?? 'Trống' }}</p>
        <p>Account: {{ $client->account ?? 'Trống' }}</p>
        <p>Avatar: <img src="{{ Storage::url($client->avatar) }}" alt="" width="120px"></p>
        <p>Project: {{ $client->project ?? 'Trống' }}</p>
        <p>Invoices: {{ $client->invoices ?? 'Trống' }}</p>
        <p>Tags: {{ $client->tags ?? 'Trống' }}</p>
        <p>Category: <span class="btn btn-light">{{ $client->tags ?? 'Trống' }}</span></p>
        <p>Status: <span class="btn btn-secondary">{{ $client->status ?? 'Trống' }}</span></p>
    </div>
@endsection
