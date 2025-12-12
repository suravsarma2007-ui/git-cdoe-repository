@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Videos Management</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('video.create') }}" class="btn btn-primary">+ Add New Video</a>
            <a href="{{ route('video.report') }}" class="btn btn-info">Report & Export</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('video.index') }}" class="row g-2">
                <div class="col-md-2">
                    <select name="program_id" class="form-select form-select-sm">
                        <option value="">All Programs</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" @selected(request('program_id') == $program->id)>
                                {{ $program->program_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="paper_id" class="form-select form-select-sm">
                        <option value="">All Papers</option>
                        @foreach($papers as $paper)
                            <option value="{{ $paper->id }}" @selected(request('paper_id') == $paper->id)>
                                {{ $paper->paper_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="emp_id" class="form-select form-select-sm">
                        <option value="">All Staff</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}" @selected(request('emp_id') == $member->id)>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="final_status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="Pending" @selected(request('final_status') == 'Pending')>Pending</option>
                        <option value="In Progress" @selected(request('final_status') == 'In Progress')>In Progress</option>
                        <option value="Completed" @selected(request('final_status') == 'Completed')>Completed</option>
                        <option value="On Hold" @selected(request('final_status') == 'On Hold')>On Hold</option>
                    </select>
                </div>
                <div class="col-md-1-5">
                    <input type="text" name="module_no" class="form-control form-control-sm" placeholder="Module No" value="{{ request('module_no') }}">
                </div>
                <div class="col-md-1-5">
                    <input type="date" name="date_from" class="form-control form-control-sm" placeholder="From Date" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-sm btn-secondary w-100">Filter</button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('video.index') }}" class="btn btn-sm btn-outline-secondary w-100">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Videos Table -->
    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped">
            <thead class="table-light">
                <tr>
                    <th>SL No</th>
                    <th>Program</th>
                    <th>Paper</th>
                    <th>Staff</th>
                    <th>Module</th>
                    <th>Semester</th>
                    <th>Videos Required</th>
                    <th>Videos Done</th>
                    <th>Videos Edited</th>
                    <th>Uploaded</th>
                    <th>Upload Date</th>
                    <th>Final Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $index => $video)
                    <tr>
                        <td>{{ ($videos->currentPage() - 1) * 15 + $index + 1 }}</td>
                        <td>{{ $video->program->program_name ?? '-' }}</td>
                        <td>{{ $video->paper->paper_name ?? '-' }}</td>
                        <td>{{ $video->staff->name ?? '-' }}</td>
                        <td>{{ $video->module_no ?? '-' }}</td>
                        <td>{{ $video->semester }}</td>
                        <td>{{ $video->total_videos_required }}</td>
                        <td>{{ $video->total_videos_done }}</td>
                        <td>{{ $video->total_videos_edited }}</td>
                        <td>{{ $video->uploaded_videos }}</td>
                        <td>{{ $video->upload_date?->toDateString() ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $video->final_status === 'Completed' ? 'success' : ($video->final_status === 'In Progress' ? 'info' : ($video->final_status === 'On Hold' ? 'warning' : 'secondary')) }}">
                                {{ $video->final_status ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('video.edit', $video->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('video.delete', $video->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted py-4">No videos found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Customized Simple Pagination -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
        <div class="mb-2 mb-md-0 text-muted small">
            Showing {{ $videos->firstItem() ?? 0 }} to {{ $videos->lastItem() ?? 0 }} of {{ $videos->total() }} records
        </div>
        <div>
            <nav>
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    @if ($videos->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $videos->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($videos->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $videos->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
