@extends('layouts.app')

@section('title', 'Sub Contractor Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sub Contractor Master</h2>
        <a href="{{ route('subcontractor.create') }}" class="btn btn-primary">Add New Sub Contractor</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sub Contractor Name</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Sub Contractor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcontractors as $subcontractor)
                    <tr>
                        <td>{{ $subcontractor->name }}</td>
                        <td>{{ $subcontractor->mobile_number }}</td>
                        <td>{{ $subcontractor->address }}</td>
                        <td>{{ $subcontractor->contractor->name ?? 'No Contractor Assigned' }}</td>                        <td>
                            <a href="{{ route('subcontractor.edit', $subcontractor) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('subcontractor.destroy', $subcontractor) }}" method="POST" class="d-inline">
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