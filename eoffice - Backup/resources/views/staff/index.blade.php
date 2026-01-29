@extends('layouts.app')

@section('title', 'Staff List - eOffice')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Staff Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('staff.create') }}" class="btn btn-primary me-2">
            <i class="bi bi-plus-circle"></i> Add New Staff
        </a>
        <a href="{{ route('staff.report') }}" class="btn btn-info">
            <i class="bi bi-file-earmark-text"></i> View Report
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Staff Records</h5>
    </div>
    <div class="card-body">
        @if ($staff->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>EMP ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Staff Type</th>
                            <th>Official Email</th>
                            <th>Contact</th>
                            <th>DOJ</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staff as $index => $member)
                            <tr>
                                <td>{{ $staff->firstItem() + $index }}</td>
                                <td><strong>{{ $member->emp_id }}</strong></td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->designation }}</td>
                                <td>
                                    <span class="badge bg-{{ $member->staff_type === 'Faculty' ? 'success' : ($member->staff_type === 'Non-Teaching' ? 'warning' : 'info') }}">
                                        {{ $member->staff_type }}
                                    </span>
                                </td>
                                <td>{{ $member->official_email ?? '-' }}</td>
                                <td>{{ $member->contact ?? '-' }}</td>
                                <td>{{ $member->doj->format('d-M-Y') }}</td>
                                <td>
                                    <a href="{{ route('staff.edit', $member) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="{{ route('staff.delete', $member) }}" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No staff records found. <a href="{{ route('staff.create') }}">Add one now</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($staff->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $staff->links() }}
                </div>
            @endif
        @else
            <div class="alert alert-info text-center py-5">
                <h5>No Staff Records Yet</h5>
                <p class="mb-3">Get started by adding your first staff member.</p>
                <a href="{{ route('staff.create') }}" class="btn btn-primary">Add Staff Member</a>
            </div>
        @endif
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
@endsection
