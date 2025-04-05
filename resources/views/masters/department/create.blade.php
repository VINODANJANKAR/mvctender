@extends('layouts.app')

@section('title', 'Add Department')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Department</h2>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="department_name" class="form-label">Department Name</label>
                    <input type="text" class="form-control @error('department_name') is-invalid @enderror" 
                           id="department_name" name="department_name" value="{{ old('department_name') }}" required>
                    @error('department_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save Department</button>
            </form>
        </div>
    </div>
@endsection 