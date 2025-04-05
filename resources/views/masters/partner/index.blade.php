@extends('layouts.app')

@section('title', 'Partner Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Partner Master</h2>
        <a href="{{ route('partners.create') }}" class="btn btn-primary">Add New Partner</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Partner Name</th>
                    <th>Mobile Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td>{{ $partner->partner_name }}</td>
                        <td>{{ $partner->mobile_number }}</td>
                        <td>
                            <a href="{{ route('partners.edit', $partner) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('partners.destroy', $partner) }}" method="POST" class="d-inline">
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