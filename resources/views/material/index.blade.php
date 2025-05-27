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
                            <th>Site Code</th>
                            <th>Party</th>
                            <th>Entry No</th>
                            <th>Challan No</th>
                            <th>Material Name</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{ $material['workOrder']->sr_no }}</td>
                                <td>{{ $material['party']->party_name }}</td>
                                <td>{{ $material->entry_no }}</td>
                                <td>{{ $material->challan_no }}</td>
                                <td>{{ $material->material_name }}</td>
                                <td>{{ $material->quantity }}</td>
                                <td>{{ $material->rate ? number_format($material->rate, 2) : '-' }}</td>
                                <td>{{ $material->amount }}</td>
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