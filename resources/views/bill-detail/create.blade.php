@extends('layouts.app')

@section('title', 'Add Bill Detail')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Add New Bill Detail</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('bill-details.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('bill-details.store') }}" method="POST">
                @csrf
                <h5>Bill Details</h5>
                <hr style="border: 1px solid black;">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        <input type="text" class="form-control @error('sitecode') is-invalid @enderror" id="site_code" name="site_code" value="" required>
                        {{-- <select name="site_code" id="site_code" class="form-control form-select @error('site_code') is-invalid @enderror" required>
                            <option value="">Select Site Code</option>
                            @foreach($workOrders as $workOrder)
                                <option value="{{ $workOrder->site_code }}">{{ $workOrder->site_code }}</option>
                            @endforeach
                        </select> --}}
                        @error('site_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                    <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="" required>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select name="department_id" id="department_id" class="form-control form-select @error('department_id') is-invalid @enderror" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="contractor_id" class="form-label">Name of Contractor</label>
                        <input type="text" class="form-control @error('contractor_id') is-invalid @enderror" id="contractor_id" name="contractor_id" required>
                        @error('contractor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="subcontractor_id" class="form-label">Subcontractor</label>
                        <select name="subcontractor_id" id="subcontractor_id" class="form-control form-select @error('subcontractor_id') is-invalid @enderror">
                            <option value="">Select Subcontractor</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                            @endforeach
                        </select>
                        @error('subcontractor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name_of_work" class="form-label">Name of Work</label>
                        <input type="text" class="form-control @error('name_of_work') is-invalid @enderror" id="name_of_work" name="name_of_work" required>
                        @error('name_of_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name_of_bank" class="form-label">Name of Bank</label>
                        <input type="text" class="form-control @error('name_of_bank') is-invalid @enderror" id="name_of_bank" name="name_of_bank" required>
                        @error('name_of_bank')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_done_by_id" class="form-label">Work Done By</label>
                        <select name="work_done_by_id" id="work_done_by_id" class="form-control form-select @error('work_done_by_id') is-invalid @enderror" required>
                            <option value="">Select Work Done By</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->partner_id }}">{{ $partner->partner_name }}</option>
                            @endforeach
                        </select>
                        @error('work_done_by_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="agreement_no" class="form-label">Agreement No</label>
                        <input type="text" class="form-control @error('agreement_no') is-invalid @enderror" id="agreement_no" name="agreement_no" required>
                        @error('agreement_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bill_no" class="form-label">Bill No/Stage</label>
                        <input type="text" class="form-control @error('bill_no') is-invalid @enderror" id="bill_no" name="bill_no" required>
                        @error('bill_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_order_amount" class="form-label">Work Order Amount</label>
                        <input type="number" step="0.01" class="form-control @error('work_order_amount') is-invalid @enderror" id="work_order_amount" name="work_order_amount" required>
                        @error('work_order_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="work_time_limit" class="form-label">Work Time Limit</label>
                        <input type="text" class="form-control @error('work_time_limit') is-invalid @enderror" id="work_time_limit" name="work_time_limit" required>
                        @error('work_time_limit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="dlp_period" class="form-label">DLP Period</label>
                        <input type="text" class="form-control @error('dlp_period') is-invalid @enderror" id="dlp_period" name="dlp_period" required>
                        @error('dlp_period')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="total_bill_amount" class="form-label">Total Bill Amount</label>
                        <input type="number" step="0.01" class="form-control @error('total_bill_amount') is-invalid @enderror" id="total_bill_amount" name="total_bill_amount" required>
                        @error('total_bill_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="deduction_amount" class="form-label">Deduction Amount</label>
                        <input type="number" step="0.01" class="form-control @error('deduction_amount') is-invalid @enderror" id="deduction_amount" name="deduction_amount" required>
                        @error('deduction_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="net_bill_amount" class="form-label">Net Bill Amount</label>
                        <input type="number" step="0.01" class="form-control @error('net_bill_amount') is-invalid @enderror" id="net_bill_amount" name="net_bill_amount" required>
                        @error('net_bill_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h4>Deductions</h4>
                <hr style="border: 1px solid black;">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="security_deposit" class="form-label">Security Deposit</label>
                        <input type="number" step="0.01" class="form-control @error('security_deposit') is-invalid @enderror" id="security_deposit" name="security_deposit" required>
                        @error('security_deposit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="insurance" class="form-label">Insurance</label>
                        <input type="number" step="0.01" class="form-control @error('insurance') is-invalid @enderror" id="insurance" name="insurance" required>
                        @error('insurance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gst" class="form-label">GST</label>
                        <input type="number" step="0.01" class="form-control @error('gst') is-invalid @enderror" id="gst" name="gst" required>
                        @error('gst')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="surcharge" class="form-label">Surcharge</label>
                        <input type="number" step="0.01" class="form-control @error('surcharge') is-invalid @enderror" id="surcharge" name="surcharge" required>
                        @error('surcharge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cess" class="form-label">Cess</label>
                        <input type="number" step="0.01" class="form-control @error('cess') is-invalid @enderror" id="cess" name="cess" required>
                        @error('cess')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tds" class="form-label">TDS</label>
                        <input type="number" step="0.01" class="form-control @error('tds') is-invalid @enderror" id="tds" name="tds" required>
                        @error('tds')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="royalty" class="form-label">Royalty</label>
                        <input type="number" step="0.01" class="form-control @error('royalty') is-invalid @enderror" id="royalty" name="royalty" required>
                        @error('royalty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="fine" class="form-label">Fine</label>
                        <input type="number" step="0.01" class="form-control @error('fine') is-invalid @enderror" id="fine" name="fine" required>
                        @error('fine')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="other" class="form-label">Other</label>
                        <input type="number" step="0.01" class="form-control @error('other') is-invalid @enderror" id="other" name="other" required>
                        @error('other')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bank_charges" class="form-label">Bank Charges</label>
                        <input type="number" step="0.01" class="form-control @error('bank_charges') is-invalid @enderror" id="bank_charges" name="bank_charges" required>
                        @error('bank_charges')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="stamp_duty" class="form-label">Stamp Duty</label>
                        <input type="number" step="0.01" class="form-control @error('stamp_duty') is-invalid @enderror" id="stamp_duty" name="stamp_duty" required>
                        @error('stamp_duty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="options" class="form-label">Options</label>
                        <input type="number" step="0.01" class="form-control @error('options') is-invalid @enderror" id="options" name="options" required>
                        @error('options')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gram_panchayat_deduction" class="form-label">Gram Panchayat Deduction</label>
                        <input type="number" step="0.01" class="form-control @error('gram_panchayat_deduction') is-invalid @enderror" id="gram_panchayat_deduction" name="gram_panchayat_deduction" required>
                        @error('gram_panchayat_deduction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gram_panchayat_emd" class="form-label">Gram Panchayat EMD</label>
                        <input type="number" step="0.01" class="form-control @error('gram_panchayat_emd') is-invalid @enderror" id="gram_panchayat_emd" name="gram_panchayat_emd" required>
                        @error('gram_panchayat_emd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark" rows="3"></textarea>
                        @error('remark')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Bill Detail</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
{{-- <script>
    document.getElementById('site_code').addEventListener('change', function() {
        const siteCode = this.value;
        if (siteCode) {
            fetch(`{{ route('bills.get-work-order-details') }}?site_code=${siteCode}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('department_id').value = data.department_id;
                        document.getElementById('name_of_work').value = data.name_of_work;
                        document.getElementById('name_of_contractor').value = data.name_of_contractor;
                        document.getElementById('work_order_amount').value = data.work_order_amount;
                        document.getElementById('work_time_limit').value = data.work_time_limit;
                        document.getElementById('dlp_period').value = data.dlp_period;
                    }
                });
        }
    });
</script> --}}
@endpush
@endsection 