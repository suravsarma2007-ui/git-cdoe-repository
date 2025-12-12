@extends('layouts.app')

@section('title', 'Papers List - eOffice')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Papers Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('paper.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Paper
        </a>
        <a href="{{ route('paper.report') }}" class="btn btn-info ms-2">
            <i class="bi bi-file-earmark-text"></i> View Report
        </a>
    </div>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('paper.index') }}" method="GET" class="row g-3">
            <div class="col-md-9">
                <input type="text" class="form-control" name="search" placeholder="Search by Paper Name, Code, or Program..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('paper.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Papers ({{ $papers->total() }})</h5>
    </div>
    <div class="card-body">
        @if ($papers->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Program Name</th>
                            <th>Program ID</th>
                            <th>Paper Code</th>
                            <th>Paper Name</th>
                            <th>Module</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($papers as $index => $paper)
                            <tr>
                                <td>{{ $papers->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $paper->program->program_name ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $paper->program->program_id ?? '-' }}</span>
                                </td>
                                <td><strong>{{ $paper->codes }}</strong></td>
                                <td>{{ $paper->paper_name }}</td>
                                <td><small>{{ $paper->module ?? '-' }}</small></td>
                                <td><span class="badge bg-warning">{{ $paper->semester }}</span></td>
                                <td><span class="badge bg-secondary">{{ $paper->years }}</span></td>
                                <td>
                                    <a href="{{ route('paper.edit', $paper) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('paper.delete', $paper) }}" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No papers found. <a href="{{ route('paper.create') }}">Add one now</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Customized Simple Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-2 mb-md-0 text-muted small">
                    Showing {{ $papers->firstItem() ?? 0 }} to {{ $papers->lastItem() ?? 0 }} of {{ $papers->total() }} records
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($papers->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $papers->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($papers->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $papers->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <h5>No Papers Yet</h5>
                <p class="mb-3">Get started by creating your first paper.</p>
                <a href="{{ route('paper.create') }}" class="btn btn-primary">Add Paper</a>
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
