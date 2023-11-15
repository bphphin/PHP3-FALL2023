@extends('layouts.app')
@section('app')
    <div class="container my-2">
        <form action="{{ route('client.update', $client) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="text" name="company_name" id="" class="form-control" placeholder="company_name"
                    value="{{ old('company_name') ?? $client->company_name }}">
                @error('company_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="file" name="avatar" id="" class="form-control">
                @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div>
                    <img src="{{ Storage::url($client->avatar) }}" alt="" width="120px">
                </div>
            </div>

            <div class="mb-3">
                <input type="text" name="account" id="" class="form-control" placeholder="account"
                    value="{{ old('account') ?? $client->account }}">
                @error('account')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="number" name="project" id="" class="form-control" placeholder="Project"
                    value="{{ old('project') ?? $client->project }}">
                @error('project')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="number" name="invoices" id="" class="form-control" placeholder="invoices"
                    value="{{ old('invoices') ?? $client->invoices }}">
                @error('invoices')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="tags" id="" class="form-control" placeholder="tags"
                    value="{{ old('tags') ?? $client->tags }}">
                @error('tags')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <select name="category" id="" class="form-control">
                    <option value="DEFAULT" {{ $client->category === 'DEFAULT' ? 'selected' : '' }}>
                        DEFAULT</option>
                    <option value="IT" {{ $client->category === 'IT' ? 'selected' : '' }}>IT
                    </option>
                </select>
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status-1">
                    <input type="radio" name="status" id="status-1" value="{{ \App\Models\Client::IS_ACTIVE }}"
                        {{ \App\Models\Client::IS_ACTIVE === $client->status ? 'checked' : '' }}>
                    {{ \App\Models\Client::IS_ACTIVE }}
                </label>
                <label for="status-2">
                    <input type="radio" name="status" id="status-2" value="{{ \App\Models\Client::IN_ACTIVE }}"
                        {{ \App\Models\Client::IN_ACTIVE === $client->status ? 'checked' : '' }}>
                    {{ \App\Models\Client::IN_ACTIVE }}
                </label>
                @error('status')
                    <span class="text-center">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success">Submit</button>
                <a href="{{ route('client.index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
