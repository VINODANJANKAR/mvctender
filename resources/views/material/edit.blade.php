@extends('layouts.app')

@section('title', 'Edit Material')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Edit Material</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('materials.update', $material->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="is_active" class="form-label">Supplier</label>
                        <select name="party_id" id="party_id" class="form-control form-select @error('party_id') is-invalid @enderror" required>
                            <option value="">Select Party</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->party_id }}" {{ old('party_id', $party->party_id) ? 'selected' : ''}}>{{ $party->party_name }}</option>
                            @endforeach
                        </select>
                        @error('party_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        <input type="text" class="form-control @error('site_code') is-invalid @enderror" id="site_code" name="site_code" value="{{ old('site_code', $material->site_code) }}">
                        @error('site_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_no" class="form-label">Entry No.</label>
                        <input type="text" class="form-control @error('entry_no') is-invalid @enderror" id="entry_no" name="entry_no" value="{{ old('entry_no', $material->entry_no) }}" required>
                        @error('entry_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ old('entry_date',  $material->entry_date->format('Y-m-d')) }}" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="challan_no" class="form-label">Challan No</label>
                        <input type="text" class="form-control @error('challan_no') is-invalid @enderror" id="challan_no" name="challan_no" value="{{ old('challan_no', $material->challan_no) }}" required>
                        @error('challan_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="challan_date" class="form-label">Challan Date</label>
                        <input type="date" class="form-control @error('challan_date') is-invalid @enderror" id="challan_date" name="challan_date" value="{{ old('challan_date', $material->challan_date->format('Y-m-d')) }}" required>
                        @error('challan_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="material_name" class="form-label">Material Name</label>
                        <input type="text" class="form-control @error('material_name') is-invalid @enderror" id="material_name" name="material_name" value="{{ old('material_name', $material->material_name) }}" required>
                        @error('material_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $material->quantity) }}">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $material->unit) }}">
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror" id="rate" name="rate" value="{{ old('rate', $material->rate) }}">
                        @error('rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $material->amount) }}" readonly>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="name_of_work" class="form-label">Name Of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" id="name_of_work" name="name_of_work" value="{{ old('name_of_work', $material->rate) }}">
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Material</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 