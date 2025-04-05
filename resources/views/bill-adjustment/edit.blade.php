@extends('layouts.app')

@section('title', 'Edit Bill Adjustment')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Edit Bill Adjustment</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('bill-adjustments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('bill-adjustments.update', $billAdjustment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $billAdjustment->date->format('Y-m-d')) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="voucher_no" class="form-label">Voucher No</label>
                        <input type="text" class="form-control @error('voucher_no') is-invalid @enderror" id="voucher_no" name="voucher_no" value="{{ old('voucher_no', $billAdjustment->voucher_no) }}" required readonly>
                        @error('voucher_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bill_detail_id" class="form-label">Bill</label>
                        <select name="bill_detail_id" id="bill_detail_id" class="form-select @error('bill_detail_id') is-invalid @enderror" required>
                            <option value="">Select Bill</option>
                            @foreach($bills as $bill)
                                <option value="{{ $bill['id'] }}" {{ old('bill_detail_id', $billAdjustment->bill_detail_id) == $bill['id'] ? 'selected' : '' }}>
                                    {{ $bill['display'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('bill_detail_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="adjustment_type" class="form-label">Adjustment Type</label>
                        <select name="adjustment_type" id="adjustment_type" class="form-select @error('adjustment_type') is-invalid @enderror" required>
                            <option value="">Select Adjustment Type</option>
                            <option value="Addition" {{ old('adjustment_type', $billAdjustment->adjustment_type) == 'Addition' ? 'selected' : '' }}>Addition</option>
                            <option value="Deduction" {{ old('adjustment_type', $billAdjustment->adjustment_type) == 'Deduction' ? 'selected' : '' }}>Deduction</option>
                        </select>
                        @error('adjustment_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="adjustment_amount" class="form-label">Adjustment Amount</label>
                        <input type="number" step="0.01" class="form-control @error('adjustment_amount') is-invalid @enderror" id="adjustment_amount" name="adjustment_amount" value="{{ old('adjustment_amount', $billAdjustment->adjustment_amount) }}" required>
                        @error('adjustment_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="3" required>{{ old('reason', $billAdjustment->reason) }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Bill Adjustment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 