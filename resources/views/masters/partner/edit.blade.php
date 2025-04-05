@extends('layouts.app')

@section('title', 'Edit Partner')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Partner</h2>
        <a href="{{ route('partners.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('partners.update', $partner) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="partner_name" class="form-label">Partner Name</label>
                    <input type="text" class="form-control @error('partner_name') is-invalid @enderror" 
                           id="partner_name" name="partner_name" value="{{ old('partner_name', $partner->partner_name) }}" required>
                    @error('partner_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" 
                           id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $partner->mobile_number) }}" required>
                    @error('mobile_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Partner</button>
            </form>
        </div>
    </div>
@endsection 