@extends('layouts.app')

@section('title', 'Edit Tender Entry')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Tender Entry</h2>
        <a href="{{ route('tenders.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenders.update', $tender) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="sr_no" class="form-label">SR No</label>
                        <input type="text" class="form-control" id="sr_no" value="{{ $tender->tender_no }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" 
                               id="entry_date" name="entry_date" value="{{ old('entry_date', $tender->entry_date) }}" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_year" class="form-label">Entry Year</label>
                        <input type="text" class="form-control @error('entry_year') is-invalid @enderror" 
                               id="entry_year" name="entry_year" value="{{ old('entry_year', $tender->entry_year) }}" required>
                        @error('entry_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="department_id" class="form-label">Name of Department</label>
                        <select class="form-control form-select @error('department_id') is-invalid @enderror" 
                                id="department_id" name="department_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->department_id }}" 
                                    {{ old('department_id', $tender->department_id) == $department->department_id ? 'selected' : '' }}>
                                    {{ $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name_of_work" class="form-label">Name of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" 
                               id="name_of_work" name="name_of_work" value="{{ old('name_of_work', $tender->work_description) }}" required>
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tender_id" class="form-label">Tender ID</label>
                        <input type="text" class="form-control @error('tender_id') is-invalid @enderror" 
                               id="tender_id" name="tender_id" value="{{ old('tender_id', $tender->tender_id) }}" required>
                        @error('tender_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tender_amount" class="form-label">Tender Amount</label>
                        <input type="number" step="0.01" class="form-control @error('tender_amount') is-invalid @enderror" 
                               id="tender_amount" name="tender_amount" value="{{ old('tender_amount', $tender->tender_amount) }}" required>
                        @error('tender_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_of_contractor" class="form-label">Name of Contractor</label>
                        <input type="text" class="form-control @error('name_of_contractor') is-invalid @enderror" 
                               id="name_of_contractor" name="name_of_contractor" value="{{ old('name_of_contractor', $tender->name_of_contractor) }}" required>
                        @error('name_of_contractor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tender_fee" class="form-label">Tender Fee</label>
                        <input type="number" step="0.01" class="form-control @error('tender_fee') is-invalid @enderror" 
                               id="tender_fee" name="tender_fee" value="{{ old('tender_fee', $tender->tender_fee) }}" required>
                        @error('tender_fee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
                {{-- <div id="contractors-container">
                    @foreach($tender->contractors as $index => $contractor)
                    <div class="contractor-section mb-4">
                        <h5>Contractor Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contractor_id" class="form-label">Contractor ID</label>
                                <select class="form-control" name="contractor_id[]" required>
                                    <option value="">Select Contractor</option>
                                    @foreach($contractors as $ctr)
                                        <option value="{{ $ctr->contractor_id }}" {{ $ctr->contractor_id == $contractor->contractor_id ? 'selected' : '' }}>
                                            {{ $ctr->contractor_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tender_fee" class="form-label">Tender Fee</label>
                                <input type="number" step="0.01" class="form-control" name="tender_fee[]" value="{{ $contractor->tender_fee }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emd_amount" class="form-label">EMD Amount</label>
                                <input type="number" step="0.01" class="form-control" name="emd_amount[]" value="{{ $contractor->emd_amount }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="paid_by" class="form-label">Paid By</label>
                                <select class="form-control" name="paid_by[]" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="Cash" {{ $contractor->paid_by == 'Cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="Cheque" {{ $contractor->paid_by == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                    <option value="Online" {{ $contractor->paid_by == 'Online' ? 'selected' : '' }}>Online</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger remove-contractor">Remove</button>
                    </div>
                    @endforeach
                </div> --}}


   <!-- Dynamic Contractor Details -->
   <div id="contractors-container" class="contractors-container">
    @foreach($tender->transactions as $transaction)
    <div class="contractor-section mb-4">
        <h5>Contractor Details</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contractor_id" class="form-label">Name of Contractor</label>
                <select class="form-control" name="contractor_id[]" required>
                    <option value="">Select Department</option>
                    @foreach($contractors as $contractor)
                        <option value="{{ $contractor->id }}" {{ $contractor->id == $transaction->contractor_id ? 'selected' : '' }}>
                            {{ $contractor->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tender_fee" class="form-label">Tender Fee</label>
                <input type="number" step="0.01" class="form-control" name="tender_fee[]" value="{{ $transaction->tender_fee }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="emd_amount" class="form-label">EMD Amount</label>
                <input type="number" step="0.01" class="form-control" name="emd_amount[]" value="{{ $transaction->emd_amount }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="paid_by" class="form-label">Paid By</label>
                <select class="form-control" name="paid_by[]" required>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->partner_id }}" {{ $partner->partner_id == $transaction->paid_by ? 'selected' : '' }}>
                            {{ $partner->partner_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-danger remove-contractor">Remove</button>
    </div>
    @endforeach
</div>

            
                <button type="button" class="btn btn-secondary mb-4" id="add-contractor">Add Another Contractor</button>
                 <div class="row">
                   {{-- <div class="col-md-6 mb-3">
                        <label for="emd_amount" class="form-label">EMD Amount</label>
                        <input type="number" step="0.01" class="form-control @error('emd_amount') is-invalid @enderror" 
                               id="emd_amount" name="emd_amount" value="{{ old('emd_amount', $tender->emd_amount) }}" required>
                        @error('emd_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  --}}
{{-- 
                    <div class="col-md-6 mb-3">
                        <label for="paid_by" class="form-label">Paid By</label>
                        <select class="form-select @error('paid_by') is-invalid @enderror" 
                                id="paid_by" name="paid_by" required>
                            <option value="">Select Partner</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}" 
                                    {{ old('paid_by', $tender->paid_by) == $partner->partner_id ? 'selected' : '' }}>
                                    {{ $partner->partner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('paid_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="work_order_amount" class="form-label">Work Order Amount</label>
                        <input type="number" step="0.01" class="form-control @error('work_order_amount') is-invalid @enderror" 
                               id="work_order_amount" name="work_order_amount" value="{{ old('work_order_amount', $tender->work_order_amount) }}" required>
                        @error('work_order_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="work_time_limit" class="form-label">Work Time Limit</label>
                        <input type="text" class="form-control @error('work_time_limit') is-invalid @enderror" 
                               id="work_time_limit" name="work_time_limit" value="{{ old('work_time_limit', $tender->work_time_limit) }}" required>
                        @error('work_time_limit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="days_months" class="form-label">Days/Months</label>
                        <input type="text" class="form-control @error('days_months') is-invalid @enderror" 
                               id="days_months" name="days_months" value="{{ old('days_months', $tender->days_months) }}" required>
                        @error('days_months')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dlp_period" class="form-label">DLP Period</label>
                        <input type="text" class="form-control @error('dlp_period') is-invalid @enderror" 
                               id="dlp_period" name="dlp_period" value="{{ old('dlp_period', $tender->dlp_period) }}" required>
                        @error('dlp_period')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input @error('work_order_received') is-invalid @enderror" 
                               id="work_order_received" name="work_order_received" value="1" 
                               {{ old('work_order_received', $tender->work_order_received) ? 'checked' : '' }}>
                        <label class="form-check-label" for="work_order_received">Work Order Received</label>
                        @error('work_order_received')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Tender Entry</button>
            </form>
        </div>
    </div>


@push('js')

{{-- <script>
    document.getElementById('add-transaction').addEventListener('click', function () {
        const container = document.getElementById('transactions-container');
        const newTransaction = document.createElement('div');
        newTransaction.className = 'transaction-section mb-4';
        newTransaction.innerHTML = `
            <h5>Transaction Details</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="contractor_id" class="form-label">Contractor ID</label>
                    <select class="form-control" name="contractor_id[]" required>
                        <option value="">Select Contractor</option>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->contractor_id }}">{{ $contractor->contractor_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="transaction_amount" class="form-label">Transaction Amount</label>
                    <input type="number" step="0.01" class="form-control" name="transaction_amount[]" placeholder="Enter Amount" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="transaction_date" class="form-label">Transaction Date</label>
                    <input type="date" class="form-control" name="transaction_date[]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <button type="button" class="btn btn-danger remove-transaction">Remove</button>
                </div>
            </div>
        `;
        container.appendChild(newTransaction);

        newTransaction.querySelector('.remove-transaction').addEventListener('click', function () {
            newTransaction.remove();
        });
    });
</script> --}}
<script>
    document.getElementById('add-contractor').addEventListener('click', function () {
        const container = document.getElementById('contractors-container');
        const newContractor = document.createElement('div');
        newContractor.className = 'contractor-section mb-4';
        newContractor.innerHTML = `
            <h5>Contractor Details</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="contractor_id" class="form-label">Name of Contractor</label>
                    <select class="form-control" name="contractor_id[]" required>
                    <option value="">Select Department</option>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tender_fee" class="form-label">Tender Fee</label>
                    <input type="number" step="0.01" class="form-control" name="tender_fee[]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="emd_amount" class="form-label">EMD Amount</label>
                    <input type="number" step="0.01" class="form-control" name="emd_amount[]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="paid_by" class="form-label">Paid By</label>
                    <select class="form-control" name="paid_by[]" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-danger remove-contractor">Remove</button>
        `;
        container.appendChild(newContractor);

        newContractor.querySelector('.remove-contractor').addEventListener('click', function () {
            newContractor.remove();
        });

        
    });

    document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-contractor')) {
        event.target.closest('.contractor-section').remove();
    }
});

</script>

    
@endpush    
@endsection 