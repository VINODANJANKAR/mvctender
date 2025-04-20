@extends('layouts.app')

@section('title', 'Edit Daily Expense')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Edit Daily Expense</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('daily-expenses.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('daily-expenses.update', $dailyExpense->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $dailyExpense->date->format('Y-m-d')) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="voucher_no" class="form-label">Voucher No</label>
                        <input type="text" class="form-control @error('voucher_no') is-invalid @enderror" id="voucher_no" name="voucher_no" value="{{ old('voucher_no', $dailyExpense->voucher_no) }}" required readonly>
                        @error('voucher_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="ac_head_id" class="form-label">Account Head</label>
                        <select name="ac_head_id" id="ac_head_id" class="form-control form-select @error('ac_head_id') is-invalid @enderror" required>
                            <option value="">Select Account Head</option>
                            @foreach($accountHeads as $accountHead)
                                <option value="{{ $accountHead->ac_head_id }}" {{ old('ac_head_id', $dailyExpense->ac_head_id) == $accountHead->ac_head_id ? 'selected' : '' }}>
                                    {{ $accountHead->ac_head_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ac_head_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="party_id" class="form-label">Party</label>
                        <select name="party_id" id="party_id" class="form-control form-select @error('party_id') is-invalid @enderror" required>
                            <option value="">Select Party</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->party_id }}" {{ old('party_id', $dailyExpense->party_id) == $party->party_id ? 'selected' : '' }}>
                                    {{ $party->party_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('party_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description', $dailyExpense->description) }}" required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $dailyExpense->amount) }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="payment_mode" class="form-label">Payment Mode</label>
                        <select name="payment_mode" id="payment_mode" class="form-control form-select @error('payment_mode') is-invalid @enderror" required>
                            <option value="">Select Payment Mode</option>
                            <option value="Cash" {{ old('payment_mode', $dailyExpense->payment_mode) == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Bank" {{ old('payment_mode', $dailyExpense->payment_mode) == 'Bank' ? 'selected' : '' }}>Bank</option>
                            <option value="UPI" {{ old('payment_mode', $dailyExpense->payment_mode) == 'UPI' ? 'selected' : '' }}>UPI</option>
                            <option value="Card" {{ old('payment_mode', $dailyExpense->payment_mode) == 'Card' ? 'selected' : '' }}>Card</option>
                            <option value="Other" {{ old('payment_mode', $dailyExpense->payment_mode) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('payment_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="reference_no" class="form-label">Reference No</label>
                        <input type="text" class="form-control @error('reference_no') is-invalid @enderror" id="reference_no" name="reference_no" value="{{ old('reference_no', $dailyExpense->reference_no) }}">
                        @error('reference_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark" rows="3">{{ old('remark', $dailyExpense->remark) }}</textarea>
                        @error('remark')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Daily Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 