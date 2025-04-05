@extends('layouts.app')

@section('title', 'Account Head Master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Account Head Master</h2>
        <a href="{{ route('account-heads.create') }}" class="btn btn-primary">Add New Account Head</a>
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
                @foreach($accountHeads as $accountHead)
                    <tr>
                        <td>{{ $accountHead->ac_head_name }}</td>
                        <td>
                            <a href="{{ route('account-heads.edit', $accountHead) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('account-heads.destroy', $accountHead) }}" method="POST" class="d-inline">
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