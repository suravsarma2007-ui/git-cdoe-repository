@extends('layouts.app')

@section('title', 'Staff Report - eOffice')

@section('content')
<style>
    @media print {
        .no-print { display: none; }
        body { font-size: 12px; }
        table { page-break-inside: avoid; }
    }
</style>

<div class="no-print">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Staff Report</h2>
        </div>
        <div class="col-md-4 text-end">
            <button onclick="window.print()" class="btn btn-secondary me-2">
                <i class="bi bi-printer"></i> Print
            </button>
            <a href="{{ route('staff.index') }}" class="btn btn-info">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Filters</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.report') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search by Name or ID</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Enter name or EMP ID">
                </div>

                <div class="col-md-3">
                    <label for="staff_type" class="form-label">Staff Type</label>
                    <select class="form-select" id="staff_type" name="staff_type">
                        <option value="">-- All Types --</option>
                        @foreach ($staffTypes as $type)
                            <option value="{{ $type }}" {{ request('staff_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="discipline" class="form-label">Discipline</label>
                    <select class="form-select" id="discipline" name="discipline">
                        <option value="">-- All Disciplines --</option>
                        @foreach ($disciplines as $disc)
                            <option value="{{ $disc }}" {{ request('discipline') === $disc ? 'selected' : '' }}>{{ $disc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('staff.report') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Staff Records (Total: {{ count($staff) }})</h5>
    </div>
    <div class="card-body">
        @if (count($staff) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>EMP ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Staff Type</th>
                            <th>Discipline</th>
                            <th>Subject</th>
                            <th>Official Email</th>
                            <th>Personal Email</th>
                            <th>Contact</th>
                            <th>DOJ</th>
                            <th style="width: 15%;">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staff as $index => $member)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $member->emp_id }}</strong></td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->designation }}</td>
                                <td>{{ $member->staff_type }}</td>
                                <td>{{ $member->discipline ?? '-' }}</td>
                                <td>{{ $member->subject ?? '-' }}</td>
                                <td>{{ $member->official_email ?? '-' }}</td>
                                <td>{{ $member->personal_email ?? '-' }}</td>
                                <td>{{ $member->contact ?? '-' }}</td>
                                <td>{{ $member->doj->format('d-M-Y') }}</td>
                                <td style="font-size: 0.9em;">{{ $member->address ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted py-4">
                                    No staff records match your filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Report Summary -->
            <div class="row mt-4 pt-3 border-top no-print">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Staff</h5>
                            <h3>{{ count($staff) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Faculty</h5>
                            <h3>{{ $staff->where('staff_type', 'Faculty')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Non-Teaching</h5>
                            <h3>{{ $staff->where('staff_type', 'Non-Teaching')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Support Staff</h5>
                            <h3>{{ $staff->where('staff_type', 'Support')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <h5>No Staff Records Found</h5>
                <p>Try adjusting your filters or <a href="{{ route('staff.index') }}">go back to the staff list</a>.</p>
            </div>
        @endif
    </div>
</div>

<div class="no-print mt-3 text-center">
    <p class="text-muted small">Generated on {{ now()->format('d-M-Y H:i:s') }}</p>
</div>
@endsection
