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

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Filter Staff</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('staff.index') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="search" class="form-label">Name or EMP ID</label>
                <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Enter name or EMP ID">
            </div>
            <div class="col-md-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ request('designation') }}" placeholder="Designation">
            </div>
            <div class="col-md-3">
                <label for="staff_type" class="form-label">Staff Type</label>
                <select class="form-select" id="staff_type" name="staff_type">
                    <option value="">-- All Types --</option>
                    <option value="Faculty" {{ request('staff_type') == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                    <option value="Non-Teaching" {{ request('staff_type') == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                    <option value="Support" {{ request('staff_type') == 'Support' ? 'selected' : '' }}>Support</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                @if(request('search') || request('designation') || request('staff_type'))
                    <a href="{{ route('staff.index') }}" class="btn btn-secondary w-100">Reset</a>
                @endif
            </div>
        </form>
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

            <!-- Customized Simple Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-2 mb-md-0 text-muted small">
                    Showing {{ $staff->firstItem() ?? 0 }} to {{ $staff->lastItem() ?? 0 }} of {{ $staff->total() }} records
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($staff->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $staff->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($staff->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $staff->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
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
