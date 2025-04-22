@extends('layouts.app')

@section('title', 'Add Unit')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add Unit</h2>
        <a href="{{ route('units.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('units.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="unit_name" class="form-label">Unit Name</label>
                    <input type="text" class="form-control @error('unit_name') is-invalid @enderror" 
                           id="unit_name" name="unit_name" value="{{ old('unit_name') }}" required>
                    @error('unit_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save Unit</button>
            </form>
        </div>
    </div>
@endsection 