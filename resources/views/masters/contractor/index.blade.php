@extends('layouts.app')

@section('title', 'Contractor Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Contractor Master</h2>
        <a href="{{ route('contractor.create') }}" class="btn btn-primary">Add New Contractor</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Contractor Name</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contractors as $contractor)
                    <tr>
                        <td>{{ $contractor->name }}</td>
                        <td>{{ $contractor->mobile_number }}</td>
                        <td>{{ $contractor->address }}</td>
                        <td>
                            <a href="{{ route('contractor.edit', $contractor) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('contractor.destroy', $contractor) }}" method="POST" class="d-inline">
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