@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h2>Videos Report</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('video.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card mb-3">
        <div class="card-header bg-light">
            <h5 class="mb-0">Filters & Export</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('video.report') }}" class="row g-2 mb-3">
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
                    <select name="semester" class="form-select form-select-sm">
                        <option value="">All Semesters</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" @selected(request('semester') == $i)>Sem {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="month" class="form-select form-select-sm">
                        <option value="">All Months</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" @selected(request('month') == $m)>
                                {{ \Carbon\Carbon::createFromFormat('m', $m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="year" class="form-select form-select-sm">
                        <option value="">All Years</option>
                        @for($y = date('Y') - 5; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 text-end">
                    <button type="submit" class="btn btn-sm btn-primary">Apply Filters</button>
                    <a href="{{ route('video.report') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                </div>
            </form>

            <!-- Export Buttons -->
            <div class="row g-2 border-top pt-3">
                <div class="col-md-12">
                    <h6 class="mb-2">Export Report:</h6>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="{{ route('video.export-csv') }}" class="d-inline">
                        @foreach(request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <input type="hidden" name="format" value="all">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV (All)
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="{{ route('video.export-excel') }}" class="d-inline">
                        @foreach(request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <input type="hidden" name="format" value="all">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel (All)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Video Entries Report</h5>
        </div>
        <div class="card-body">
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
                            <th>Month</th>
                            <th>Year</th>
                            <th>Final Status</th>
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
                                <td>{{ $video->month }}</td>
                                <td>{{ $video->year }}</td>
                                <td>
                                    <span class="badge bg-{{ $video->final_status === 'Completed' ? 'success' : ($video->final_status === 'In Progress' ? 'info' : ($video->final_status === 'On Hold' ? 'warning' : 'secondary')) }}">
                                        {{ $video->final_status ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="text-center text-muted py-4">No video entries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
