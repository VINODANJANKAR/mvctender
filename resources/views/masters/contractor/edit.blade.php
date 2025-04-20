@extends('layouts.app')

@section('title', 'Edit contractor')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit contractor</h2>
        <a href="{{ route('contractor.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('contractor.update', $contractor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">contractor Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $contractor->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" 
                           id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $contractor->mobile_number) }}" required>
                    @error('mobile_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update contractor</button>
            </form>
        </div>
    </div>
@endsection 