@extends('layouts.app')

@section('title', 'Add Material')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Add New Material</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('materials.store') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- <div class="col-md-4 mb-3">
                        <label for="material_code" class="form-label">Material Code</label>
                        <input type="text" class="form-control @error('material_code') is-invalid @enderror" id="material_code" name="material_code" value="{{ $materialCode }}" required readonly>
                        @error('material_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-4 mb-3">
                        <label for="is_active" class="form-label">Supplier</label>
                        <select name="party_id" id="party_id" class="form-control form-select @error('party_id') is-invalid @enderror" required>
                            <option value="">Select Party</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->party_id }}">{{ $party->party_name }}</option>
                            @endforeach
                        </select>
                        @error('party_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        {{-- <input type="text" class="form-control @error('sitecode') is-invalid @enderror" id="site_code" name="site_code" value="" required> --}}
                        <select name="site_code" id="site_code" class="form-control form-select @error('site_code') is-invalid @enderror" required>
                            <option value="">Select Site Code</option>
                            @foreach($workOrders as $workOrder)
                                <option value="{{ $workOrder->id }}">{{ $workOrder->sr_no }}</option>
                            @endforeach
                        </select>
                        @error('site_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_no" class="form-label">Entry No.</label>
                        <input type="text" class="form-control @error('entry_no') is-invalid @enderror" id="entry_no" name="entry_no" value="{{ $materialCode }}" required readonly>
                        @error('entry_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="challan_no" class="form-label">Challan No</label>
                        <input type="text" class="form-control @error('challan_no') is-invalid @enderror" id="challan_no" name="challan_no" required>
                        @error('challan_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="challan_date" class="form-label">Challan Date</label>
                        <input type="date" class="form-control @error('challan_date') is-invalid @enderror" id="challan_date" name="challan_date" required>
                        @error('challan_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="material_name" class="form-label">Material Name</label>
                        <input type="text" class="form-control @error('material_name') is-invalid @enderror" id="material_name" name="material_name" required>
                        @error('material_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="unit" class="form-label">Unit (Kg/Ltr)</label>
                        <select name="unit" id="unit" class="form-control form-select @error('unit') is-invalid @enderror" required>
                            <option value="">Select Unit</option>
                            <option value="Kgs">Kgs</option>
                            <option value="Mtr">Mtr</option>
                            <option value="Ltr">Ltr</option>
                            <option value="Pair">Pair</option>
                            <option value="Bag">Bag</option>
                            <option value="Brass">Brass</option>
                            <option value="Nos">Nos</option>
                        </select>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="number" class="form-control @error('rate') is-invalid @enderror" id="rate" name="rate">
                        @error('rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="other_charges" class="form-label">Other Charges</label>
                        <input type="number" class="form-control @error('other_charges') is-invalid @enderror" id="other_charges" name="other_charges" data-type="charge">
                        @error('other_charges')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" readonly>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="name_of_work" class="form-label">Name Of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" id="name_of_work" name="name_of_work">
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="remark" class="form-label">Remarks</label>
                        <input type="text" class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark">
                        @error('remark')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Material</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 