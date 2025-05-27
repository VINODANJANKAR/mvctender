@extends('layouts.app')

@section('title', 'Add Bill Adjustment')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Add New Bill Adjustment</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('bill-adjustments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('bill-adjustments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $currentDate }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" required>
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" required>
                        @error('account_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="col-md-4 mb-3">
                        <label for="voucher_no" class="form-label">Voucher No</label>
                        <input type="text" class="form-control @error('voucher_no') is-invalid @enderror" id="voucher_no" name="voucher_no" value="" required >
                        @error('voucher_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    {{-- <div class="col-md-4 mb-3">
                        <label for="bill_detail_id" class="form-label">Bill</label>
                        <select name="bill_detail_id" id="bill_detail_id" class="form-select @error('bill_detail_id') is-invalid @enderror" required>
                            <option value="">Select Bill</option>
                            @foreach($bills as $bill)
                                <option value="{{ $bill['id'] }}">{{ $bill['display'] }}</option>
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
                            <option value="Addition">Addition</option>
                            <option value="Deduction">Deduction</option>
                        </select>
                        @error('adjustment_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
                <div class="row">    
                    
                    <div class="col-md-4 mb-3">
                        <label for="beneficiary_name" class="form-label">Beneficiary Name</label>
                        <input type="text" class="form-control @error('beneficiary_name') is-invalid @enderror" id="beneficiary_name" name="beneficiary_name" required>
                        @error('beneficiary_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name_of_ref_person" class="form-label">Name of Person (Ref party) </label>
                        <input type="text" class="form-control @error('name_of_ref_person') is-invalid @enderror" id="name_of_ref_person" name="name_of_ref_person" required>
                        @error('name_of_ref_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="paid_by" class="form-label">Work Done By</label>
                        <select class="form-control form-select @error('paid_by') is-invalid @enderror" 
                                id="paid_by" name="paid_by" required>
                            <option value="">Select Partner</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}" 
                                    {{ old('paid_by') == $partner->partner_id ? 'selected' : '' }}>
                                    {{ $partner->partner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('paid_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
                <div class="row">    
                    <div class="col-md-4 mb-3">
                        <label for="rtgs_amt" class="form-label">RTGS Amt</label>
                        <input type="text" class="form-control @error('rtgs_amt') is-invalid @enderror" id="rtgs_amt" name="rtgs_amt" required>
                        @error('rtgs_amt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="commision_rate" class="form-label">Commission Rate</label>
                        <input type="text" class="form-control @error('commision_rate') is-invalid @enderror" id="commision_rate" name="commision_rate" required>
                        @error('commision_rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="net_amt" class="form-label">Net Amount</label>
                        <input type="text" class="form-control @error('net_amt') is-invalid @enderror" id="net_amt" name="net_amt" required readonly>
                        @error('net_amt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
                <div class="row">
                    <h2>Amount Received From Party</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="amt_received_from" class="form-label">Amount Received From</label>
                        <input type="text" class="form-control @error('amt_received_from') is-invalid @enderror" id="amt_received_from" name="amt_received_from" required>
                        @error('amt_received_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="amt_recevied_date" class="form-label">Amount Recevied Date</label>
                        <input type="date" class="form-control @error('amt_recevied_date') is-invalid @enderror" id="amt_recevied_date" name="amt_recevied_date" required>
                        @error('amt_recevied_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="recevied_amount" class="form-label">Recevied Amount</label>
                        <input type="text" class="form-control @error('recevied_amount') is-invalid @enderror" id="recevied_amount" name="recevied_amount" required>
                        @error('recevied_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-6     mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks" rows="4" required>{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Bill Adjustment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 