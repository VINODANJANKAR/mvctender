@extends('layouts.app')

@section('title', 'Edit Account Head')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Account Head</h2>
        <a href="{{ route('account-heads.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('account-heads.update', $accountHead) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="ac_head_name" class="form-label">Account Head Name</label>
                    <input type="text" class="form-control @error('ac_head_name') is-invalid @enderror" 
                           id="ac_head_name" name="ac_head_name" value="{{ old('ac_head_name', $accountHead->ac_head_name) }}" required>
                    @error('ac_head_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Account Head</button>
            </form>
        </div>
    </div>
@endsection 