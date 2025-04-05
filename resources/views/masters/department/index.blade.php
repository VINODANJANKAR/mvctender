@extends('layouts.app')

@section('title', 'Department Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Department Master</h2>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Add New Department</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->department_name }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
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