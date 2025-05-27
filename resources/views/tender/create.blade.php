@extends('layouts.app')

@section('title', 'Add Tender Entry')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Tender Entry</h2>
        <a href="{{ route('tenders.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenders.store') }}" method="POST" id="tenderForm">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="sr_no" class="form-label">SR No</label>
                        <input type="text" class="form-control" id="sr_no" name="sr_no" value="{{ $tenderNo }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" 
                               id="entry_date" name="entry_date" value="" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="entry_year" class="form-label">Entry Year</label>
                        <input type="text" class="form-control @error('entry_year') is-invalid @enderror" 
                               id="entry_year" name="entry_year" value="" required>
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
                                    {{ old('department_id') == $department->department_id ? 'selected' : '' }}>
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
                               id="name_of_work" name="name_of_work" value="{{ old('name_of_work') }}" required>
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tender_id" class="form-label">Tender ID</label>
                        <input type="text" class="form-control @error('tender_id') is-invalid @enderror" 
                               id="tender_id" name="tender_id" value="{{ old('tender_id') }}" required>
                        @error('tender_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tender_amount" class="form-label">Tender Amount</label>
                        <input type="number" step="0.01" class="form-control @error('tender_amount') is-invalid @enderror" 
                               id="tender_amount" name="tender_amount" value="{{ old('tender_amount') }}" required>
                        @error('tender_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- <div id="contractors-container">
                    <div class="contractor-section mb-4">
                        <h5>Contractor Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name_of_contractor" class="form-label">Name of Contractor</label>
                                <input type="text" class="form-control @error('name_of_contractor') is-invalid @enderror" 
                                       id="name_of_contractor" name="name_of_contractor" value="{{ old('name_of_contractor') }}" required>
                                @error('name_of_contractor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tender_fee" class="form-label">Tender Fee</label>
                                <input type="number" step="0.01" class="form-control @error('tender_fee') is-invalid @enderror" 
                                       id="tender_fee" name="tender_fee" value="{{ old('tender_fee') }}" required>
                                @error('tender_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emd_amount" class="form-label">EMD Amount</label>
                                <input type="number" step="0.01" class="form-control @error('emd_amount') is-invalid @enderror" 
                                       id="emd_amount" name="emd_amount" value="{{ old('emd_amount') }}" required>
                                @error('emd_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="paid_by" class="form-label">Paid By</label>
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
                    </div>
                </div> --}}
                    <!-- Dynamic Contractor Details -->
    <div id="contractors-container">
        <div class="contractor-section mb-4">
            <h5>Contractor Details</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="contractor_id" class="form-label">Name of Contractor</label>
                    {{-- <input type="text" class="form-control" name="name_of_contractor[]" required> --}}
                    {{-- <label for="paid_by" class="form-label">Paid By</label> --}}
                    <select class="form-control" name="contractor_id[]" required>
                        <option value="">Select Contractor</option>
                        @foreach($parties as $party)
                        <option value="{{ $party->party_id }}" 
                            {{ old('paid_by') == $party->party_id ? 'selected' : '' }}>
                            {{ $party->party_name }}
                        </option>
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
                        <option value="">Select Partner</option>
                        @foreach($partners as $partner)
                        <option value="{{ $partner->partner_id }}" 
                            {{ old('paid_by') == $partner->partner_id ? 'selected' : '' }}>
                            {{ $partner->partner_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="emd_amount_refund" class="form-label">Emd Amount Refund</label>
                    <select class="form-control" name="emd_amount_refund[]" required>
                        <option value="">Select Partner</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
            {{-- <button type="button" class="btn btn-danger remove-contractor">Remove</button> --}}
        </div>
    </div>
                <button type="button" class="btn btn-secondary mb-4" id="add-contractor">Add Another Contractor</button>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="work_order_amount" class="form-label">Work Order Amount</label>
                        <input type="number" step="0.01" class="form-control @error('work_order_amount') is-invalid @enderror" 
                               id="work_order_amount" name="work_order_amount" value="{{ old('work_order_amount') }}" >
                        @error('work_order_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="work_time_limit" class="form-label">Work Time Limit</label>
                        <input type="date" class="form-control @error('work_time_limit') is-invalid @enderror" 
                               id="work_time_limit" name="work_time_limit" value="{{ old('work_time_limit') }}" >
                        @error('work_time_limit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="days_months" class="form-label">Days/Months</label>
                        <input type="text" class="form-control @error('days_months') is-invalid @enderror" 
                               id="days_months" name="days_months" value="{{ old('days_months') }}" >
                        @error('days_months')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dlp_period" class="form-label">DLP Period</label>
                        <input type="text" class="form-control @error('dlp_period') is-invalid @enderror" 
                               id="dlp_period" name="dlp_period" value="{{ old('dlp_period') }}" >
                        @error('dlp_period')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input @error('work_order_received') is-invalid @enderror" 
                               id="work_order_received" name="work_order_received" value="1" 
                               {{ old('work_order_received') ? 'checked' : '' }}>
                        <label class="form-check-label" for="work_order_received">Work Order Received</label>
                        @error('work_order_received')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Tender Entry</button>
            </form>
        </div>
    </div>

    @push('js')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contractorsContainer = document.getElementById('contractors-container');
            const addContractorButton = document.getElementById('add-contractor');
            let contractorCount = 1;

            addContractorButton.addEventListener('click', function() {
                if (contractorCount >= 3) {
                    alert('Maximum 3 contractors allowed');
                    return;
                }

                const contractorSection = document.createElement('div');
                contractorSection.className = 'contractor-section mb-4 border-top pt-4';
                contractorSection.innerHTML = `
                    <h5>Contractor Details ${contractorCount + 1}</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name of Contractor</label>
                            <input type="text" class="form-control" name="name_of_contractor_${contractorCount + 1}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tender Fee</label>
                            <input type="number" step="0.01" class="form-control" name="tender_fee_${contractorCount + 1}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">EMD Amount</label>
                            <input type="number" step="0.01" class="form-control" name="emd_amount_${contractorCount + 1}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paid By</label>
                            <select class="form-control form-select" name="paid_by_${contractorCount + 1}" required>
                                <option value="">Select Partner</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-contractor">Remove Contractor</button>
                `;

                contractorsContainer.appendChild(contractorSection);
                contractorCount++;

                // Add remove button functionality
                const removeButton = contractorSection.querySelector('.remove-contractor');
                removeButton.addEventListener('click', function() {
                    contractorSection.remove();
                    contractorCount--;
                });
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
                    <label for="name_of_contractor" class="form-label">Name of Contractor</label>
                    <select class="form-control" name="contractor_id[]" required>
                        <option value="">Select Contractor</option>
                        @foreach($parties as $party)
                            <option value="{{ $party->party_id }}" 
                                {{ old('contractor_id') == $party->party_id ? 'selected' : '' }}>
                                {{ $party->party_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tender_fee" class="form-label">Tender Fee</label>
                    <input type="number" step="0.01" class="form-control" name="tender_fee[]" placeholder="Enter Tender Fee" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="emd_amount" class="form-label">EMD Amount</label>
                    <input type="number" step="0.01" class="form-control" name="emd_amount[]" placeholder="Enter EMD Amount" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="paid_by" class="form-label">Paid By</label>
                    <select class="form-control" name="paid_by[]" required>
                        <option value="">Select Partner</option>
                        @foreach($partners as $partner)
                        <option value="{{ $partner->partner_id }}" 
                            {{ old('paid_by') == $partner->partner_id ? 'selected' : '' }}>
                            {{ $partner->partner_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="emd_amount_refund" class="form-label">Emd Amount Refund Status</label>
                    <select class="form-control" name="emd_amount_refund[]" required>
                        <option value="">Select Refund Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-danger remove-contractor">Remove</button>
        `;

        container.appendChild(newContractor);

        // Add event listener to dynamically created "Remove" button
        newContractor.querySelector('.remove-contractor').addEventListener('click', function () {
            newContractor.remove();
        });
    });
</script>

    @endpush
@endsection 