@extends('layouts.app')

@section('title', 'Edit Sub Contractor')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit contractor</h2>
        <a href="{{ route('subcontractor.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('subcontractor.update', $subcontractor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">

                
                <div class="col-md-4">
                    <label for="name" class="form-label">Sub Contractor Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $subcontractor->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" 
                           id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $subcontractor->mobile_number) }}" required>
                    @error('mobile_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="row">
                        <div class="col-md-4">
                            <label for="address" class="form-label">Contractor Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                               id="name" name="address" value="{{ old('address', $subcontractor->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contractor_id" class="form-label">Name of Contractor</label>
                            <select class="form-control form-select @error('contractor_id') is-invalid @enderror" 
                                    id="contractor_id" name="contractor_id" required>
                                <option value="">Select Contractor</option>
                                @foreach($contractors as $contractor)
                                    <option value="{{ $contractor->id }}" 
                                        {{ old('contractor_id', $subcontractor->contractor_id) == $contractor->id ? 'selected' : '' }}>
                                        {{ $contractor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('contractor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                    </div>

                <button type="submit" class="btn btn-primary">Update contractor</button>
            </form>
        </div>
    </div>
@endsection 