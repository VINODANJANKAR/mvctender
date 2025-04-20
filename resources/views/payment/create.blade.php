@extends('layouts.app')

@section('title', 'Add Payment Entry')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Add New Payment Entry</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="paid_to" class="form-label">Paid to</label>
                        <input type="text" class="form-control @error('paid_to') is-invalid @enderror" id="paid_to" name="paid_to" value="" required>
                        @error('paid_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="gst_amount" class="form-label">GST Amount</label>
                        <input type="number" step="0.01" class="form-control @error('gst_amount') is-invalid @enderror" id="gst_amount" name="gst_amount" required>
                        @error('gst_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" class="form-control @error('total_amount') is-invalid @enderror" id="total_amount" name="total_amount" required>
                        @error('total_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="payment_mode" class="form-label">Payment Mode</label>
                        <select name="payment_mode" id="payment_mode" class="form-control form-select @error('payment_mode') is-invalid @enderror" required>
                            <option value="">Select Payment Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>
                            <option value="UPI">UPI</option>
                            <option value="Card">Card</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('payment_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="beneficiary_name" class="form-label">Beneficiary Name</label>
                        <input type="text" class="form-control @error('beneficiary_name') is-invalid @enderror" id="beneficiary_name" name="beneficiary_name">
                        @error('beneficiary_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="partner_id" class="form-label">Paid By</label>
                        <select name="partner_id" id="partner_id" class="form-control form-select @error('partner_id') is-invalid @enderror" required>
                            <option value="">Select Party</option>
                            @foreach($partners as $partner)
                            <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                            @endforeach
                        </select>
                        @error('partner_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name">
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bank_ac_name" class="form-label">Bank A/c Name</label>
                        <input type="text" class="form-control @error('bank_ac_name') is-invalid @enderror" id="bank_ac_name" name="bank_ac_name">
                        @error('bank_ac_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Payment Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 