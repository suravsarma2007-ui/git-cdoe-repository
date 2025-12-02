@extends('layouts.app')

@section('title', 'Program List - eOffice')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Program Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('program.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Program
        </a>
    </div>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('program.index') }}" method="GET" class="row g-3">
            <div class="col-md-9">
                <input type="text" class="form-control" name="search" placeholder="Search by Program Name, ID, or Code..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('program.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Programs ({{ $programs->total() }})</h5>
    </div>
    <div class="card-body">
        @if ($programs->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Program Name</th>
                            <th>Program ID</th>
                            <th>Session Year</th>
                            <th>Program Code</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $index => $program)
                            <tr>
                                <td>{{ $programs->firstItem() + $index }}</td>
                                <td><strong>{{ $program->program_name }}</strong></td>
                                <td><span class="badge bg-info">{{ $program->program_id }}</span></td>
                                <td>{{ $program->session_year }}</td>
                                <td><span class="badge bg-secondary">{{ $program->program_code }}</span></td>
                                <td><small>{{ $program->created_at->format('d-M-Y') }}</small></td>
                                <td>
                                    <a href="{{ route('program.edit', $program) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="{{ route('program.delete', $program) }}" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No programs found. <a href="{{ route('program.create') }}">Add one now</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($programs->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $programs->links() }}
                </div>
            @endif
        @else
            <div class="alert alert-info text-center py-5">
                <h5>No Programs Yet</h5>
                <p class="mb-3">Get started by creating your first program.</p>
                <a href="{{ route('program.create') }}" class="btn btn-primary">Add Program</a>
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
