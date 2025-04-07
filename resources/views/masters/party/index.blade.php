@extends('layouts.app')

@section('title', 'Parties Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Party Master</h2>
        <a href="{{ route('parties.create') }}" class="btn btn-primary">Add New Party</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Parties Name</th>
                    <th>Mobile Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parties as $party)
                    <tr>
                        <td>{{ $party->partner_name }}</td>
                        <td>{{ $party->mobile_number }}</td>
                        <td>
                            <a href="{{ route('parties.edit', $partner) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('parties.destroy', $partner) }}" method="POST" class="d-inline">
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