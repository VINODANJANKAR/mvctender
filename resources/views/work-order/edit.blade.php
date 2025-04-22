@extends('layouts.app')

@section('title', 'Edit Work Order Entry')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Work Order Entry</h2>
        <a href="{{ route('work-orders.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('work-orders.update', $workOrder) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="sr_no" class="form-label">SR No</label>
                        <input type="text" class="form-control" id="sr_no" value="{{ $workOrder->tender->tender_no }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        <input type="text" class="form-control" id="site_code" value="{{ $workOrder->sr_no }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" 
                               id="entry_date" name="entry_date" value="{{ old('entry_date', $workOrder->entry_date->format('Y-m-d')) }}" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="entry_year" class="form-label">Order Year</label>
                        <input type="text" class="form-control @error('entry_year') is-invalid @enderror" 
                               id="entry_year" name="entry_year" value="{{ old('entry_year', $workOrder->entry_year) }}" required readonly>
                        @error('entry_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="department_id" class="form-label">Name of Department</label>
                        <select class="form-control form-select @error('department_id') is-invalid @enderror" 
                                id="department_id" name="department_id" required readonly>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->department_id }}" 
                                    {{ old('department_id', $workOrder->department_id) == $department->department_id ? 'selected' : '' }}>
                                    {{ $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name_of_contractor" class="form-label">Name of Contactor</label>
                        <input type="text" class="form-control @error('name_of_contractor') is-invalid @enderror" 
                               id="name_of_contractor" name="name_of_contractor" value="{{ old('name_of_contractor', $workOrder->name_of_contractor) }}" required>
                        {{-- <select class="form-control form-select @error('contractor_id') is-invalid @enderror" 
                                id="contractor_id" name="contractor_id" required>
                            <option value="">Select Department</option>
                            @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}" 
                                {{ old('contractor_id', $workOrder->contractor_id) == $contractor->id ? 'selected' : '' }}>
                                {{ $contractor->name }}
                            </option>
                        @endforeach
                        </select> --}}
                        @error('name_of_contractor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="name_of_subcontractor" class="form-label">Subcontractor Name</label>
                        <input type="text" class="form-control @error('name_of_subcontractor') is-invalid @enderror" 
                               id="name_of_subcontractor" name="name_of_subcontractor" value="{{ old('name_of_subcontractor', $workOrder->name_of_subcontractor) }}" required>
                        {{-- <select class="form-control form-select @error('subcontractor_id') is-invalid @enderror" 
                                id="subcontractor_id" name="subcontractor_id" required>
                            <option value="">Select Subcontractor</option>
                            @foreach($subcontractors as $scontractor)
                                <option value="{{ $scontractor->id }}" 
                                    {{ old('subcontractor_id', $workOrder->subcontractor_id) == $scontractor->id ? 'selected' : '' }}>
                                    {{ $scontractor->name }}
                                </option>
                            @endforeach
                        </select> --}}
                        @error('name_of_subcontractor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name_of_work" class="form-label">Name of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" 
                               id="name_of_work" name="name_of_work" value="{{ old('name_of_work', $workOrder->name_of_work) }}" required readonly>
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_head" class="form-label">Work Head</label>
                        <input type="text" class="form-control @error('work_head') is-invalid @enderror" 
                               id="work_head" name="work_head" value="{{ old('work_head', $workOrder->work_head) }}" required>
                        @error('work_head')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="work_done_by_id" class="form-label">Work Done By</label>
                        <select class="form-control form-select @error('work_done_by_id') is-invalid @enderror" 
                                id="work_done_by_id" name="work_done_by_id" required>
                            <option value="">Select Partner</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}" 
                                    {{ old('work_done_by_id', $workOrder->work_done_by) == $partner->partner_id ? 'selected' : '' }}>
                                    {{ $partner->partner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('work_done_by_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="agreement_no" class="form-label">Agreement No</label>
                        <input type="text" class="form-control @error('agreement_no') is-invalid @enderror" 
                               id="agreement_no" name="agreement_no" value="{{ old('agreement_no', $workOrder->agreement_no) }}" required>
                        @error('agreement_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_order_no" class="form-label">Work Order No</label>
                        <input type="text" class="form-control @error('work_order_no') is-invalid @enderror" 
                               id="work_order_no" name="work_order_no" value="{{ old('work_order_no', $workOrder->work_order_no) }}" required>
                        @error('work_order_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="work_order_date" class="form-label">Work Order Date</label>
                        <input type="date" class="form-control @error('work_order_date') is-invalid @enderror" 
                               id="work_order_date" name="work_order_date" value="{{ old('work_order_date', $workOrder->work_order_date->format('Y-m-d')) }}" required>
                        @error('work_order_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_order_amount" class="form-label">Work Order Amount</label>
                        <input type="number" step="0.01" class="form-control @error('work_order_amount') is-invalid @enderror" 
                               id="work_order_amount" name="work_order_amount" value="{{ old('work_order_amount', $workOrder->work_order_amount) }}" required>
                        @error('work_order_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_time_limit" class="form-label">Work Time Limit</label>
                        <input type="text" class="form-control @error('work_time_limit') is-invalid @enderror" 
                               id="work_time_limit" name="work_time_limit" value="{{ old('work_time_limit', $workOrder->work_time_limit) }}" required>
                        @error('work_time_limit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="dlp_period" class="form-label">DLP Period</label>
                        <input type="text" class="form-control @error('dlp_period') is-invalid @enderror" 
                               id="dlp_period" name="dlp_period" value="{{ old('dlp_period', $workOrder->dlp_period) }}" required>
                        @error('dlp_period')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="security_deposit_amount" class="form-label">Security Deposit Amount</label>
                        <input type="number" step="0.01" class="form-control @error('security_deposit_amount') is-invalid @enderror" 
                               id="security_deposit_amount" name="security_deposit_amount" value="{{ old('security_deposit_amount', $workOrder->security_deposite) }}" required>
                        @error('security_deposit_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="additional_security_deposit_amount" class="form-label">Additional Security Deposit Amount</label>
                        <input type="number" step="0.01" class="form-control @error('additional_security_deposit_amount') is-invalid @enderror" 
                               id="additional_security_deposit_amount" name="additional_security_deposit_amount" value="{{ old('additional_security_deposit_amount', $workOrder->additional_security_deposit) }}" required>
                        @error('additional_security_deposit_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>

                 <!-- Security Deposit Details -->
    <div id="security-deposit-container">
        @foreach($workOrder->securityDeposite as $deposit)
        <div class="security-deposit-row mb-4">
            <div class="row">
               
                <div class="col-md-4 mb-3">
                    <label for="security_deposit_fdr_no" class="form-label">FDR No (Security Deposit)</label>
                    <input type="text" class="form-control" name="security_deposit_fdr_no[]" value="{{ $deposit->security_deposit_fdr_no }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="security_deposit_fdr_amt" class="form-label">FDR Amt (Security Deposit)</label>
                    <input type="number" step="0.01" class="form-control" name="security_deposit_fdr_amt[]" value="{{ $deposit->security_deposit_fdr_amt }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="security_deposit_fdr_bank" class="form-label">FDR Bank (Security Deposit)</label>
                    <input type="text" class="form-control" name="security_deposit_fdr_bank[]" value="{{ $deposit->security_deposit_fdr_bank }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="security_deposit_paid_by" class="form-label">Paid By</label>
                    <select class="form-control" name="security_deposit_paid_by[]" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->partner_id }}" {{ $deposit->security_deposit_paid_by == $partner->partner_id ? 'selected' : '' }}>
                                {{ $partner->partner_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-danger remove-security-deposit">Remove</button>
                </div>
                
            </div>
        </div>
        @endforeach

    </div>
    <button type="button" class="btn btn-secondary mb-4" id="add-security-deposit">Add Another Security Deposite</button>

                 <!-- Additional Security Deposit Section -->
    <h4>Additional Security Deposits</h4>
    <div id="additional-security-deposit-container">
        @foreach($workOrder->addSecurityDeposite as $deposit)
        <div class="additional-security-deposit-row mb-4">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="additional_security_deposit_fdr_no" class="form-label">FDR No (Additional Security Deposit)</label>
                    <input type="text" class="form-control" name="additional_security_deposit_fdr_no[]" value="{{ $deposit->additional_security_deposit_fdr_no }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="additional_security_deposit_fdr_amt" class="form-label">FDR Amt (Additional Security Deposit)</label>
                    <input type="number" step="0.01" class="form-control" name="additional_security_deposit_fdr_amt[]" value="{{ $deposit->additional_security_deposit_fdr_amt }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="additional_security_deposit_fdr_bank" class="form-label">FDR Bank (Additional Security Deposit)</label>
                    <input type="text" class="form-control" name="additional_security_deposit_fdr_bank[]" value="{{ $deposit->additional_security_deposit_fdr_bank }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="additional_security_deposit_paid_by" class="form-label">Paid By</label>
                    <select class="form-control" name="additional_security_deposit_paid_by[]" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->partner_id }}" {{ $deposit->additional_security_deposit_paid_by == $partner->partner_id ? 'selected' : '' }}>
                                {{ $partner->partner_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-danger remove-additional-security-deposit">Remove</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-secondary mb-4" id="add-additional-security-deposit">Add Another Security Deposite</button>


                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="bond_amount" class="form-label">Bond Amount</label>
                        <input type="number" step="0.01" class="form-control @error('bond_amount') is-invalid @enderror" 
                               id="bond_amount" name="bond_amount" value="{{ old('bond_amount', $workOrder->bond_amount) }}" required>
                        @error('bond_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="bond_amount_bank" class="form-label">Bond Amount Bank</label>
                        <input type="text" class="form-control @error('bond_amount_bank') is-invalid @enderror" 
                               id="bond_amount_bank" name="bond_amount_bank" value="{{ old('bond_amount_bank', $workOrder->bond_amount_bank) }}" required>
                        @error('bond_amount_bank')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bond_amount_paid_by" class="form-label">Bond Amount Paid By</label>
                        <select class="form-control form-select @error('bond_amount_paid_by') is-invalid @enderror" 
                                id="bond_amount_paid_by" name="bond_amount_paid_by" required>
                            <option value="">Select Partner</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}" 
                                    {{ old('bond_amount_paid_by', $workOrder->bond_amount_paid_by) == $partner->partner_id ? 'selected' : '' }}>
                                    {{ $partner->partner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('bond_amount_paid_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" id="submitButton">Update Work Order Entry</button>
            </form>
        </div>
    </div>


 
@push('js')

<script>
document.getElementById('add-security-deposit').addEventListener('click', function () {
    const container = document.getElementById('security-deposit-container');
    const newRow = document.createElement('div');
    newRow.className = 'security-deposit-row mb-4';
    newRow.innerHTML = `
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="security_deposit_fdr_no" class="form-label">FDR No (Security Deposit)</label>
                <input type="text" class="form-control" name="security_deposit_fdr_no[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="security_deposit_fdr_amt" class="form-label">FDR Amt (Security Deposit)</label>
                <input type="number" step="0.01" class="form-control" name="security_deposit_fdr_amt[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="security_deposit_fdr_bank" class="form-label">FDR Bank (Security Deposit)</label>
                <input type="text" class="form-control" name="security_deposit_fdr_bank[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="security_deposit_paid_by" class="form-label">Paid By</label>
                <select class="form-control" name="security_deposit_paid_by[]" required>
                    <option value="">Select Partner</option>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <button type="button" class="btn btn-danger remove-security-deposit">Remove</button>
            </div>
        </div>
    `;

    container.appendChild(newRow);
});

// Use event delegation to handle click events on remove buttons
document.getElementById('security-deposit-container').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-security-deposit')) {
        event.target.closest('.security-deposit-row').remove();
    }
});





// document.getElementById('add-additional-security-deposit').addEventListener('click', function () {
//     const container = document.getElementById('additional-security-deposit-container');
//     const newRow = document.createElement('div');
//     newRow.className = 'additional-security-deposit-row mb-4';
//     newRow.innerHTML = `
//         <div class="row">
            
//             <div class="col-md-4 mb-3">
//                 <label for="additional_security_deposit_fdr_no" class="form-label">FDR No (Additional Security Deposit)</label>
//                 <input type="text" class="form-control" name="additional_security_deposit_fdr_no[]" required>
//             </div>
//             <div class="col-md-4 mb-3">
//                 <label for="additional_security_deposit_fdr_amt" class="form-label">FDR Amt (Additional Security Deposit)</label>
//                 <input type="number" step="0.01" class="form-control" name="additional_security_deposit_fdr_amt[]" required>
//             </div>
//             <div class="col-md-4 mb-3">
//                 <label for="additional_security_deposit_fdr_bank" class="form-label">FDR Bank (Additional Security Deposit)</label>
//                 <input type="text" class="form-control" name="additional_security_deposit_fdr_bank[]" required>
//             </div>
//             <div class="col-md-4 mb-3">
//                 <label for="additional_security_deposit_paid_by" class="form-label">Paid By</label>
//                 <select class="form-control" name="additional_security_deposit_paid_by[]" required>
//                     <option value="">Select Partner</option>
//                     @foreach($partners as $partner)
//                         <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
//                     @endforeach
//                 </select>
//             </div>
//             <div class="col-md-4 mb-3">
//                 <button type="button" class="btn btn-danger remove-additional-security-deposit">Remove</button>
//             </div>
//         </div>
//     `;

//     container.appendChild(newRow);

//     newRow.querySelector('.remove-additional-security-deposit').addEventListener('click', function () {
//         newRow.remove();
//     });
// });


// // stop button to submit multiple 
// document.getElementById('submitButton').addEventListener('click', function () {
//     this.disabled = true; // Disable the button
//     this.innerText = 'Submitting...'; // Change text to indicate action
// });


document.getElementById('add-additional-security-deposit').addEventListener('click', function () {
    const container = document.getElementById('additional-security-deposit-container');
    const newRow = document.createElement('div');
    newRow.className = 'additional-security-deposit-row mb-4';
    newRow.innerHTML = `
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="additional_security_deposit_fdr_no" class="form-label">FDR No (Additional Security Deposit)</label>
                <input type="text" class="form-control" name="additional_security_deposit_fdr_no[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="additional_security_deposit_fdr_amt" class="form-label">FDR Amt (Additional Security Deposit)</label>
                <input type="number" step="0.01" class="form-control" name="additional_security_deposit_fdr_amt[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="additional_security_deposit_fdr_bank" class="form-label">FDR Bank (Additional Security Deposit)</label>
                <input type="text" class="form-control" name="additional_security_deposit_fdr_bank[]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="additional_security_deposit_paid_by" class="form-label">Paid By</label>
                <select class="form-control" name="additional_security_deposit_paid_by[]" required>
                    <option value="">Select Partner</option>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <button type="button" class="btn btn-danger remove-additional-security-deposit">Remove</button>
            </div>
        </div>
    `;

    container.appendChild(newRow);
});

// Use event delegation to handle click events on remove buttons
document.getElementById('additional-security-deposit-container').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-additional-security-deposit')) {
        event.target.closest('.additional-security-deposit-row').remove();
    }
});


</script>
@endpush    
@endsection 