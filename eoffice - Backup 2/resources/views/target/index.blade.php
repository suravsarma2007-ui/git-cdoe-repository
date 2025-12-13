@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Targets</h4>
        <div>
            <a class="btn btn-primary" href="{{ route('target.create') }}">Create</a>
            <a class="btn btn-success" href="{{ route('target.exportCsv', request()->all()) }}">Download CSV</a>
        </div>
    </div>

    <form method="GET" action="{{ route('target.index') }}" class="row g-2 mb-3">
        <div class="col-md-2">
            <select name="module_id" class="form-select">
                <option value="">All Modules</option>
                @foreach($modules as $m)
                    <option value="{{ $m->slno }}" @selected(request('module_id') == $m->slno)>{{ $m->moduleNo ?? $m->moduleno ?? $m->module_no }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="week_id" class="form-select">
                <option value="">All Weeks</option>
                @foreach($weeks as $w)
                    <option value="{{ $w->id }}" @selected(request('week_id') == $w->id)>Week {{ $w->week_no }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" @selected(request('program_id') == $p->id)>{{ $p->program_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="paper_id" class="form-select">
                <option value="">All Papers</option>
                @foreach($papers as $paper)
                    <option value="{{ $paper->id }}" @selected(request('paper_id') == $paper->id)>{{ $paper->paper_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                @foreach($faculties as $f)
                    <option value="{{ $f->id }}" @selected(request('emp_id') == $f->id)>{{ $f->name }} ({{ $f->emp_id }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="NA" @selected(request('status')=='NA')>NA</option>
                <option value="Pending" @selected(request('status')=='Pending')>Pending</option>
                <option value="Completed" @selected(request('status')=='Completed')>Completed</option>
            </select>
        </div>
        <div class="col-12 col-md-2 mt-2 mt-md-0">
            <button class="btn btn-primary w-100" type="submit">Filter</button>
        </div>
    </form>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Faculty Name</th>
                <th>Program</th>
                <th>Paper Name</th>
                <th>Module No</th>
                <th>Week No</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($targets as $row)
            <tr>
                <td>{{ $row->slno }}</td>
                <td>{{ $row->staff?->name }}</td>
                <td>{{ $row->program?->program_name }}</td>
                <td>{{ $row->paper?->paper_name }}</td>
                <td>{{ $row->module?->moduleNo ?? $row->module?->moduleno ?? $row->module?->module_no }}</td>
                <td>{{ $row->week?->week_no }}</td>
                <td>{{ $row->from_date }}</td>
                <td>{{ $row->to_date }}</td>
                <td>{{ $row->status }}</td>
                <td>{{ $row->remark }}</td>
                <td>
                    <a class="btn btn-sm btn-warning" href="{{ route('target.edit', $row) }}">Edit</a>
                    <form method="POST" action="{{ route('target.destroy', $row) }}" class="d-inline" onsubmit="return confirm('Delete this target?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="11" class="text-center">No targets found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $targets->links() }}
</div>
@endsection
