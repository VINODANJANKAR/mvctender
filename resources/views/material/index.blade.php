@extends('layouts.app')

@section('title', 'Materials')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Materials</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('materials.create') }}" class="btn btn-primary">Add New Material</a>
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
                            <th>Material Code</th>
                            <th>Material Name</th>
                            <th>Unit</th>
                            <th>Rate</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{ $material->material_code }}</td>
                                <td>{{ $material->material_name }}</td>
                                <td>{{ $material->unit }}</td>
                                <td>{{ $material->rate ? number_format($material->rate, 2) : '-' }}</td>
                                <td>{{ $material->description }}</td>
                                <td>
                                    <span class="badge bg-{{ $material->is_active ? 'success' : 'danger' }}">
                                        {{ $material->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('materials.destroy', $material) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
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