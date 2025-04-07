@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        $(document).ready(function(){
          $("#entry_date").change(function(){
             // Get the selected date
             const selectedDate = new Date($(this).val());
                const year = selectedDate.getFullYear();
                const month = selectedDate.getMonth() + 1; // Months are zero-based
                const shortYear = year % 100; // e.g., 2025 becomes 25

                // Determine the financial year in short format
                const financialYear = month >= 4 
                    ? `${shortYear}-${(shortYear + 1) % 100}`
                    : `${(shortYear - 1) % 100}-${shortYear}`;

                // Update the financial year input field
                $('#entry_year').val(financialYear);
        });
        });
    </script> 
    
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
                            <select class="form-select" name="paid_by_${contractorCount + 1}" required>
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
@stop