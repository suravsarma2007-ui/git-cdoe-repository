@extends('layouts.app')

@section('title', 'Paper Allocations - eOffice')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Paper Allocations</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('paper_allocation.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Allocation
        </a>
        <a href="{{ route('paper_allocation.export-csv', request()->query()) }}" class="btn btn-outline-secondary ms-2">CSV</a>
        <a href="{{ route('paper_allocation.export-excel', request()->query()) }}" class="btn btn-outline-secondary ms-2">Excel</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('paper_allocation.index') }}" method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by paper or faculty" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="program_id" class="form-select">
                    <option value="">-- All Programs --</option>
                    @foreach($programs as $p)
                        <option value="{{ $p->id }}" {{ request('program_id') == $p->id ? 'selected' : '' }}>{{ $p->program_name }} ({{ $p->program_id }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="semester" class="form-select">
                    <option value="">-- Semester --</option>
                    @for($i=1;$i<=8;$i++)
                        <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>Sem {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <select name="year" class="form-select">
                    <option value="">-- Year --</option>
                    @php $current = date('Y'); @endphp
                    @for($y = $current - 5; $y <= $current + 1; $y++)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('paper_allocation.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        @if ($allocations->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program</th>
                            <th>Paper</th>
                            <th>Faculty</th>
                            <th>Module No</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th>Week No</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allocations as $idx => $a)
                            <tr>
                                <td>{{ $allocations->firstItem() + $idx }}</td>
                                <td>{{ $a->paper->program->program_name ?? '-' }}</td>
                                <td>{{ $a->paper->paper_name ?? '-' }}</td>
                                <td>{{ $a->staff->name ?? '-' }}</td>
                                <td>{{ $a->module_no ?? '-' }}</td>
                                <td>{{ $a->semester }}</td>
                                <td>{{ $a->year }}</td>
                                <td>{{ $a->week_no }}</td>
                                <td>{{ $a->date?->toDateString() ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('paper_allocation.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('paper_allocation.delete', $a) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $allocations->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info">No allocations yet.</div>
        @endif
    </div>
</div>
@endsection
