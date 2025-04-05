@extends('layouts.app')

@section('title', 'Work Order Entries')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Work Order Entries</h2>
        <a href="{{ route('work-orders.create') }}" class="btn btn-primary">Add New Work Order Entry</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SR No</th>
                    <th>Site Code</th>
                    <th>Entry Date</th>
                    <th>Order Year</th>
                    <th>Department</th>
                    <th>Contractor</th>
                    <th>Work Order No</th>
                    <th>Work Order Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workOrders as $workOrder)
                    <tr>
                        <td>{{ $workOrder->sr_no }}</td>
                        <td>{{ $workOrder->site_code }}</td>
                        <td>{{ $workOrder->entry_date->format('d-m-Y') }}</td>
                        <td>{{ $workOrder->order_year }}</td>
                        <td>{{ $workOrder->department->department_name }}</td>
                        <td>{{ $workOrder->name_of_contractor }}</td>
                        <td>{{ $workOrder->work_order_no }}</td>
                        <td>{{ number_format($workOrder->work_order_amount, 2) }}</td>
                        <td>
                            <a href="{{ route('work-orders.edit', $workOrder) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('work-orders.destroy', $workOrder) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection 