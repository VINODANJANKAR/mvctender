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
                        <label for="paid_to" class="form-label">Paid to</label>
                        <input type="text" class="form-control @error('paid_to') is-invalid @enderror" id="paid_to" name="paid_to" value="{{ old('paid_to', $payment->paid_to) }}" required>
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
                            <option value="">Select Party</option>
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

                    
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Payment Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 