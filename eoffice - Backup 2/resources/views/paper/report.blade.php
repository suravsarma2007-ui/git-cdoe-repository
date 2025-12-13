@extends('layouts.app')

@section('title', 'Papers Report - eOffice')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Papers Report</h2>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Filter Report</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('paper.report') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="program_id" class="form-label">Program</label>
                            <select class="form-select" id="program_id" name="program_id">
                                <option value="">-- All Programs --</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->program_name }} ({{ $program->program_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester">
                                <option value="">-- All Semesters --</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="years" class="form-label">Year</label>
                            <select class="form-select" id="years" name="years">
                                <option value="">-- All Years --</option>
                                @for ($i = 2025; $i <= 2035; $i++)
                                    <option value="{{ $i }}" {{ request('years') == $i ? 'selected' : '' }}>Year {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   placeholder="Paper name or code..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter Report
                        </button>
                        <a href="{{ route('paper.report') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @if ($papers->count() > 0)
            <div class="card">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Papers List ({{ $papers->count() }} records)</h5>
                    <div class="btn-group" role="group">
                        <a href="{{ route('paper.export-csv', request()->query()) }}" class="btn btn-sm btn-light" title="Download CSV">
                            <i class="bi bi-file-csv"></i> CSV
                        </a>
                        <a href="{{ route('paper.export-excel', request()->query()) }}" class="btn btn-sm btn-light" title="Download Excel">
                            <i class="bi bi-file-earmark-excel"></i> Excel
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 3%">#</th>
                                <th style="width: 12%">Program Name</th>
                                <th style="width: 10%">Program ID</th>
                                <th style="width: 15%">Paper Code</th>
                                <th style="width: 20%">Paper Name</th>
                                <th style="width: 12%">Module</th>
                                <th style="width: 8%">Semester</th>
                                <th style="width: 8%">Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($papers as $key => $paper)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $paper->program->program_name }}</td>
                                    <td>{{ $paper->program->program_id }}</td>
                                    <td>{{ $paper->codes }}</td>
                                    <td>{{ $paper->paper_name }}</td>
                                    <td>{{ $paper->module ?? '-' }}</td>
                                    <td>Sem {{ $paper->semester }}</td>
                                    <td>Year {{ $paper->years }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">
                                        No records found matching your filter criteria
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $papers->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                No papers found. 
                <a href="{{ route('paper.create') }}">Create a new paper</a>
            </div>
        @endif
    </div>
</div>
@endsection
