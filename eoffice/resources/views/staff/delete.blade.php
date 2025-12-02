@extends('layouts.app')

@section('title', 'Delete Staff - eOffice')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Delete Staff Member</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h5 class="alert-heading">Are you sure?</h5>
                    <p>You are about to permanently delete the following staff member:</p>
                </div>

                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <p class="mb-2"><strong>Name:</strong> {{ $staff->name }}</p>
                        <p class="mb-2"><strong>Employee ID:</strong> {{ $staff->emp_id }}</p>
                        <p class="mb-2"><strong>Designation:</strong> {{ $staff->designation }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $staff->official_email ?? '-' }}</p>
                        <p class="mb-0"><strong>Date of Joining:</strong> {{ $staff->doj->format('d-M-Y') }}</p>
                    </div>
                </div>

                <p class="text-muted mb-4">
                    <i class="bi bi-exclamation-triangle"></i>
                    This action cannot be undone. This staff member's record will be permanently deleted from the system.
                </p>

                <div class="d-flex gap-2">
                    <form action="{{ route('staff.confirm-delete', $staff) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Yes, Delete Permanently
                        </button>
                    </form>
                    <a href="{{ route('staff.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
