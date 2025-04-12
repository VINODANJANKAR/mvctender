@extends('layouts.app')

@section('title', 'Tender Entries')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tender Entries</h2>
        <a href="{{ route('tenders.create') }}" class="btn btn-primary">Add New Tender Entry</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SR No</th>
                    <th>Entry Date</th>
                    <th>Entry Year</th>
                    <th>Department</th>
                    <th>Name of Work</th>
                    <th>Tender ID</th>
                    <th>Tender Amount</th>
                    <th>Contractor</th>
                    <th>Work Order Amount</th>
                    <th>Work Order Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenders as $tender)
                    <tr>
                        <td>{{ $tender->tender_no }}</td>
                        <td>{{ $tender->entry_date }}</td>
                        <td>{{ $tender->entry_year }}</td>
                        <td>{{ $tender->department->department_name }}</td>
                        <td>{{ $tender->name_of_work }}</td>
                        <td>{{ $tender->tender_id }}</td>
                        <td>{{ number_format($tender->tender_amount, 2) }}</td>
                        <td>{{ $tender->name_of_contractor }}</td>
                        <td>{{ number_format($tender->work_order_amount, 2) }}</td>
                        <td>
                            @if($tender->work_order_received)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tenders.edit', $tender) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('tenders.destroy', $tender) }}" method="POST" class="d-inline">
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