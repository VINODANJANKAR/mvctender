@extends('layouts.app')

@section('title', 'Bill Adjustments')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Bill Adjustments</h2>
        </div>
        <div class="col-md-6 text-end">
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
                            <th>Bill No</th>
                            <th>Department</th>
                            <th>Adjustment Type</th>
                            <th>Amount</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adjustments as $adjustment)
                            <tr>
                                <td>{{ $adjustment->date->format('d-m-Y') }}</td>
                                <td>{{ $adjustment->voucher_no }}</td>
                                <td>{{ $adjustment->billDetail->bill_no }}</td>
                                <td>{{ $adjustment->billDetail->workOrder->department->department_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $adjustment->adjustment_type === 'Addition' ? 'success' : 'danger' }}">
                                        {{ $adjustment->adjustment_type }}
                                    </span>
                                </td>
                                <td>{{ number_format($adjustment->adjustment_amount, 2) }}</td>
                                <td>{{ $adjustment->reason }}</td>
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