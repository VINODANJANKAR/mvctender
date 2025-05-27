@extends('layouts.app')

@section('title', 'Edit Payment Entry')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Edit Payment Entry</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $payment->date->format('Y-m-d')) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="paid_to" class="form-label">Paid To</label>
                        <select name="paid_to" id="paid_to" class="form-control form-select @error('paid_to') is-invalid @enderror" required>
                            <option value="">Select Party</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->party_id }}" {{ old('paid_to', $payment->paid_to) == $party->party_id ? 'selected' : '' }}>
                                    {{ $party->party_type }}
                                </option>
                            @endforeach
                        </select>
                        @error('paid_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description', $payment->description) }}">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gst_amount" class="form-label">GST Amount</label>
                        <input type="number" step="0.01" class="form-control @error('gst_amount') is-invalid @enderror" id="gst_amount" name="gst_amount" value="{{ old('gst_amount', $payment->gst_amount) }}" required>
                        @error('gst_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="other_charges" class="form-label">Other Charges</label>
                        <input type="number" step="0.01" class="form-control @error('other_charges') is-invalid @enderror" id="other_charges" name="other_charges" value="{{ old('other_charges', $payment->other_charges) }}" required>
                        @error('other_charges')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" class="form-control @error('total_amount') is-invalid @enderror" id="total_amount" name="total_amount" value="{{ old('total_amount', $payment->total_amount) }}" required>
                        @error('total_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="payment_mode" class="form-label">Payment Mode</label>
                        <select name="payment_mode" id="payment_mode" class="form-control form-select @error('payment_mode') is-invalid @enderror" required>
                            <option value="">Select Payment Mode</option>
                            <option value="Cash" {{ old('payment_mode', $payment->payment_mode) == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Bank" {{ old('payment_mode', $payment->payment_mode) == 'Bank' ? 'selected' : '' }}>Bank</option>
                            <option value="UPI" {{ old('payment_mode', $payment->payment_mode) == 'UPI' ? 'selected' : '' }}>UPI</option>
                            <option value="Card" {{ old('payment_mode', $payment->payment_mode) == 'Card' ? 'selected' : '' }}>Card</option>
                            <option value="Other" {{ old('payment_mode', $payment->payment_mode) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('payment_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="beneficiary_name" class="form-label">Beneficiary Name</label>
                        <input type="text" class="form-control @error('beneficiary_name') is-invalid @enderror" id="beneficiary_name" name="beneficiary_name" value="{{ old('beneficiary_name', $payment->beneficiary_name) }}">
                        @error('beneficiary_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="partner_id" class="form-label">Paid By</label>
                        <select name="partner_id" id="partner_id" class="form-control form-select @error('partner_id') is-invalid @enderror" required>
                            <option value="">Select Partner</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}" {{ old('partner_id', $payment->partner_id) == $partner->partner_id ? 'selected' : '' }}>
                                    {{ $partner->partner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('partner_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ old('bank_name', $payment->bank_name) }}">
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bank_ac_name" class="form-label">Bank A/c Name</label>
                        <input type="text" class="form-control @error('bank_ac_name') is-invalid @enderror" id="bank_ac_name" name="bank_ac_name" value="{{ old('bank_ac_name', $payment->bank_ac_name) }}">
                        @error('bank_ac_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="ref" class="form-label">Reference</label>
                        <input type="text" class="form-control @error('ref') is-invalid @enderror" id="ref" name="ref" value="{{ old('ref', $payment->ref) }}">
                        @error('ref')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" value="{{ old('remarks', $payment->remarks) }}">
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Payment Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 