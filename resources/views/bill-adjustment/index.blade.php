@extends('layouts.app')

@section('title', 'Bill Adjustments')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Bill Adjustments</h2>
        </div>
        <div class="col-lg-6 text-end">
            <a href="{{ route('bill-adjustments.create') }}" class="btn btn-primary">Add New Adjustment</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Voucher No</th>
                            <th>Bank Name</th>
                            <th>Account Nubmer</th>
                            <th>Beneficiary Name</th>
                            <th>name of Ref Person</th>
                            <th>Paid By </th>
                            <th>RTGS Amount</th>
                            <th>Commission Rate</th>
                            <th>Net Amount</th>
                            <th>Recevied Date</th>
                            <th>Recevied Amount</th>
                            <th>Description</th>
                            <th>Remarks</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adjustments as $adjustment)
                            <tr>
                                <td>{{ $adjustment->date->format('d-m-Y') }}</td>
                                <td>{{ $adjustment->voucher_no }}</td>
                                <td>{{ $adjustment->bank_name}}</td>
                                <td>{{ $adjustment->account_number }}</td>
                                <td>{{ $adjustment->beneficiary_name }}</td>
                                <td>{{ $adjustment->name_of_ref_person }}</td>
                                <td>{{ $adjustment->paid_by }}</td>
                                <td>{{ $adjustment->rtgs_amt }}</td>
                                <td>{{ $adjustment->commision_rate }}</td>
                                <td>{{ $adjustment->net_amt }}</td>
                                <td>{{ $adjustment->amt_recevied_date }}</td>
                                <td>{{ $adjustment->recevied_amount }}</td>
                                <td>{{ $adjustment->description }}</td>
                                <td>{{ $adjustment->remarks }}</td>
                                <td>{{ $adjustment->created_at }}</td>

                                <td>
                                    <a href="{{ route('bill-adjustments.edit', $adjustment) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('bill-adjustments.destroy', $adjustment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this adjustment?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 