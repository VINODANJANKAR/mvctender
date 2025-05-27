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
                        <select name="site_code" id="site_code" class="form-control form-select @error('site_code') is-invalid @enderror" required>
                            <option value="">Select Site Code</option>
                            @foreach($workOrders as $workOrder)
                                <option value="{{ $workOrder->id }}" {{ $material->site_code == $workOrder->id ? 'selected' : '' }}>
                                    {{ $workOrder->sr_no }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_no" class="form-label">Entry No.</label>
                        <input type="text" class="form-control @error('entry_no') is-invalid @enderror" id="entry_no" name="entry_no" value="{{ old('entry_no', $material->entry_no) }}" required readonly>
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
                        <select name="unit" id="unit" class="form-control form-select @error('unit') is-invalid @enderror" required>
                            <option value="">Select Unit</option>
                            <option value="Kgs" {{ old('unit', $material->unit) == 'Kgs' ? 'selected' : '' }}>Kgs</option>
                            <option value="Mtr" {{ old('unit', $material->unit) == 'Mtr' ? 'selected' : '' }}>Mtr</option>
                            <option value="Ltr" {{ old('unit', $material->unit) == 'Ltr' ? 'selected' : '' }}>Ltr</option>
                            <option value="Pair" {{ old('unit', $material->unit) == 'Pair' ? 'selected' : '' }}>Pair</option>
                            <option value="Bag" {{ old('unit', $material->unit) == 'Bag' ? 'selected' : '' }}>Bag</option>
                            <option value="Brass" {{ old('unit', $material->unit) == 'Brass' ? 'selected' : '' }}>Brass</option>
                            <option value="Nos" {{ old('unit', $material->unit) == 'Nos' ? 'selected' : '' }}>Nos</option>
                        </select>
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
                        <label for="other_charges" class="form-label">Other Charges</label>
                        <input type="number" class="form-control @error('other_charges') is-invalid @enderror" id="other_charges" name="other_charges" value="{{ old('other_charges', $material->other_charges) }}">
                        @error('other_charges')
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

                    <div class="col-md-4 mb-3">
                        <label for="remark" class="form-label">Remarks</label>
                        <input type="text" class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark" value="{{ old('remark', $material->remark) }}">
                        @error('remark')
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