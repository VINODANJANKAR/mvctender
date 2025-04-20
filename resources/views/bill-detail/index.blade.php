@extends('layouts.app')

@section('title', 'Bill Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Bill Details</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('bill-details.create') }}" class="btn btn-primary">Add New Bill Detail</a>
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
                            <th>Site Code</th>
                            <th>Year</th>
                            <th>Date</th>
                            <th>Department</th>
                            <th>Contractor</th>
                            <th>Bill No/Stage</th>
                            <th>Total Bill Amount</th>
                            <th>Net Bill Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{ $bill->site_code }}</td>
                                <td>{{ $bill->year }}</td>
                                <td>{{ $bill->date->format('d-m-Y') }}</td>
                                <td>{{ $bill->department->department_name }}</td>
                                <td>{{ $bill->contractor_id }}</td>
                                <td>{{ $bill->bill_no }}</td>
                                <td>{{ number_format($bill->total_bill_amount, 2) }}</td>
                                <td>{{ number_format($bill->net_bill_amount, 2) }}</td>
                                <td>
                                    <a href="{{ route('bill-details.edit', $bill) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('bill-details.destroy', $bill) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this bill detail?')">Delete</button>
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