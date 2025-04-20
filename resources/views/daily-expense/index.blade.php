@extends('layouts.app')

@section('title', 'Daily Expenses')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Daily Expenses</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('daily-expenses.create') }}" class="btn btn-primary">Add New Expense</a>
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
                            <th>Sote Code</th>
                            <th>Date</th>
                            <th>Voucher No</th>
                            <th>Paid To</th>
                            <th>Paid by</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{ $expense->site_code }}</td>
                                <td>{{ $expense->entry_date->format('d-m-Y') }}</td>
                                <td>{{ $expense->entry_no }}</td>
                                <td>{{ $expense->paid_to }}</td>
                                <td>{{ $expense['partner']->partner_name }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ $expense->payment_mode }}</td>
                                <td>
                                    <a href="{{ route('daily-expenses.edit', $expense) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('daily-expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
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