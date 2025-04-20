@extends('layouts.app')

@section('title', 'Payment Entries')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Payment Entries</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('payments.create') }}" class="btn btn-primary">Add New Payment</a>
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
                            <th>Paid to</th>
                            <th>Paid By</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>GST Amount</th>
                            <th>Total Amount</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->date->format('d-m-Y') }}</td>
                                <td>{{ $payment->paid_to }}</td>
                                <td>{{ $payment->partner->partner_name }}</td>
                                <td>{{ $payment->payment_mode }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->gst_amount }}</td>
                                <td>{{ $payment->total_amount ?: '-' }}</td>
                                <td>{{ $payment->description ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment entry?')">Delete</button>
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