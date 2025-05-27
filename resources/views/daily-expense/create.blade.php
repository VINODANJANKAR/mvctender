@extends('layouts.app')

@section('title', 'Add Daily Expense')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Add New Daily Expense</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('daily-expenses.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('daily-expenses.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="entry_no" class="form-label">Entry No</label>
                        <input type="text" class="form-control @error('entry_no') is-invalid @enderror" id="entry_no" name="entry_no" value="{{ $voucherNo }}" required readonly>
                        @error('entry_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ $currentDate }}" required readonly>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="expense_date" class="form-label">Expense Date</label>
                        <input type="date" class="form-control @error('expense_date') is-invalid @enderror" id="expense_date" name="expense_date" value="{{ $currentDate }}" required>
                        @error('expense_date')
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
                        <label for="name_of_work" class="form-label">Name of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" id="name_of_work" name="name_of_work">
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="paid_to" class="form-label">Paid to</label>
                        <select name="paid_to" id="paid_to" class="form-control form-select @error('paid_to') is-invalid @enderror" required>
                            <option value="">Select party</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->party_id }}">{{ $party->party_type }}</option>
                            @endforeach
                        </select>
                        @error('paid_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="payment_through" class="form-label">Payment Through</label>
                        <input type="text" class="form-control @error('payment_through') is-invalid @enderror" id="payment_through" name="payment_through" required>
                        @error('payment_through')
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
                        <label for="payment_mode" class="form-label">Mode of Payment</label>
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
                        <label for="voucher_book_no" class="form-label">Voucher Book No.</label>
                        <input type="text" class="form-control @error('voucher_book_no') is-invalid @enderror" id="voucher_book_no" name="voucher_book_no">
                        @error('voucher_book_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="voucher_no" class="form-label">Voucher No.</label>
                        <input type="text" class="form-control @error('voucher_no') is-invalid @enderror" id="voucher_no" name="voucher_no">
                        @error('voucher_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="paid_by" class="form-label">Paid By</label>
                        <select name="paid_by" id="paid_by" class="form-control form-select @error('paid_by') is-invalid @enderror" required>
                            <option value="">Select Partner</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                            @endforeach
                        </select>
                        @error('paid_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="expense_type" class="form-label">Expense Type</label>
                        <select name="expense_type" id="expense_type" class="form-control form-select @error('expense_type') is-invalid @enderror" required>
                            <option value="">Select Partner</option>
                            <option value="Site">Site Expense</option>
                            <option value="Office">Office Expense</option>
                        </select>
                        @error('expense_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Daily Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.getElementById('site_code').addEventListener('change', function() {
            const siteCode = this.value;
            console.log("Selected Site code:", siteCode);

            if (siteCode) {
                fetch(`/daily-expense/get-workorder-details?site_code=${siteCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('name_of_work').value = data.name_of_work;
                            // document.getElementById('name_of_contractor').value = data.name_of_contractor;
                        }
                    })
                    .catch(error => console.error('Error fetching tender details:', error));
            }
        });
    </script>
@endpush
@endsection 