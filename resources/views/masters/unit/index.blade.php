@extends('layouts.app')

@section('title', 'Account Head Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Account Head Master</h2>
        <a href="{{ route('units.create') }}" class="btn btn-primary">Add New Account Head</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Account Head Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit->unit_name }}</td>
                        <td>
                            <a href="{{ route('units.edit', $unit) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('units.destroy', $unit) }}" method="POST" class="d-inline">
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