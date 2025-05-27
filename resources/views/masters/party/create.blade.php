@extends('layouts.app')

@section('title', 'Add Party')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Party</h2>
        <a href="{{ route('parties.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('parties.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="party_type" class="form-label">Party Type</label>
                    <select class="form-control form-select @error('party_type') is-invalid @enderror" 
                            id="party_type" name="party_type" required>
                        <option value="">Select Party Type</option>
                        <option value="Supplier" {{ old('party_type') == 'Supplier' ? 'selected' : '' }}>Supplier</option>
                        <option value="Contractor" {{ old('party_type') == 'Contractor' ? 'selected' : '' }}>Contractor</option>
                        <option value="Labour Contractor" {{ old('party_type') == 'Labour Contractor' ? 'selected' : '' }}>Labour Contractor</option>
                    </select>
                    @error('party_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="party_name" class="form-label">Party Name</label>
                    <input type="text" class="form-control @error('party_name') is-invalid @enderror" 
                           id="party_name" name="party_name" value="{{ old('party_name') }}" required>
                    @error('party_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                           id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                    @error('contact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                           id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gst_number" class="form-label">GST Number</label>
                    <input type="text" class="form-control @error('gst_number') is-invalid @enderror" 
                           id="gst_number" name="gst_number" value="{{ old('gst_number') }}" >
                    @error('gst_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save Party</button>
            </form>
        </div>
    </div>
@endsection 