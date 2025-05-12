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
                        <label for="entry_no" class="form-label">Entry No</label>
                        <input type="text" class="form-control @error('entry_no') is-invalid @enderror" id="entry_no" name="entry_no" value="{{ old('entry_no', $dailyExpense->entry_no) }}" required readonly>
                        @error('entry_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ old('entry_date', $dailyExpense->entry_date->format('Y-m-d')) }}" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="expense_date" class="form-label">Expense Date</label>
                        <input type="date" class="form-control @error('expense_date') is-invalid @enderror" id="expense_date" name="expense_date" value="{{ old('expense_date', $dailyExpense->expense_date->format('Y-m-d')) }}" required>
                        @error('expense_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        <input type="text" class="form-control @error('site_code') is-invalid @enderror" id="site_code" name="site_code" value="{{ old('site_code', $dailyExpense->site_code) }}">
                        @error('site_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name_of_work" class="form-label">Name Of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" id="name_of_work" name="name_of_work" value="{{ old('name_of_work', $dailyExpense->name_of_work) }}">
                        @error('name_of_work')
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
                        <label for="paid_to" class="form-label">Paid To</label>
                        <input type="text" class="form-control @error('paid_to') is-invalid @enderror" id="paid_to" name="paid_to" value="{{ old('paid_to', $dailyExpense->paid_to) }}">
                        @error('paid_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="payment_through" class="form-label">Payment Through</label>
                        <input type="text" class="form-control @error('payment_through') is-invalid @enderror" id="payment_through" name="payment_through" value="{{ old('payment_through', $dailyExpense->payment_through) }}">
                        @error('payment_through')
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
                        <label for="paid_by" class="form-label">Paid By</label>
                        <select name="paid_by" id="paid_by" class="form-control form-select @error('paid_by') is-invalid @enderror" required>
                            <option value="">Select Party</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}" {{ old('paid_by', $dailyExpense->paid_by) == $partner->partner_id ? 'selected' : '' }}>
                                    {{ $partner->partner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('paid_by')
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