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
                            <th>Voucher No</th>
                            <th>Party</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Reference No</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->date->format('d-m-Y') }}</td>
                                <td>{{ $payment->voucher_no }}</td>
                                <td>{{ $payment->party->party_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $payment->payment_type === 'Received' ? 'success' : 'danger' }}">
                                        {{ $payment->payment_type }}
                                    </span>
                                </td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_mode }}</td>
                                <td>{{ $payment->reference_no ?: '-' }}</td>
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