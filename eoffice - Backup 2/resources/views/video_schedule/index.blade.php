@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Video Recording Schedule</h4>
        <div>
            <a class="btn btn-primary" href="{{ route('video_schedule.create') }}">Create</a>
            <a class="btn btn-success" href="{{ route('video_schedule.exportCsv', request()->all()) }}">Download CSV</a>
        </div>
    </div>

    <form method="GET" action="{{ route('video_schedule.index') }}" class="row g-2 mb-3">
        <div class="col-md-2">
            <select name="module_id" class="form-select" placeholder="Module">
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
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                @foreach($faculties as $f)
                    <option value="{{ $f->id }}" @selected(request('emp_id') == $f->id)>{{ $f->name }} ({{ $f->emp_id }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="record_date" class="form-control" value="{{ request('record_date') }}" />
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Filter</button>
        </div>
    </form>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Faculty Name</th>
                <th>Program</th>
                <th>Paper Name</th>
                <th>Module No</th>
                <th>Week No</th>
                <th>Record Date</th>
                <th>From Time</th>
                <th>To Time</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $row)
            <tr>
                <td>{{ $row->staff?->name }}</td>
                <td>{{ $row->program?->program_name }}</td>
                <td>{{ $row->paper?->paper_name }}</td>
                <td>{{ $row->module?->moduleNo ?? $row->module?->moduleno ?? $row->module?->module_no }}</td>
                <td>{{ $row->week?->week_no }}</td>
                <td>{{ $row->record_date }}</td>
                <td>{{ $row->from_time }}</td>
                <td>{{ $row->to_time }}</td>
                <td>{{ $row->status }}</td>
                <td>{{ $row->remark }}</td>
                <td>
                    <a class="btn btn-sm btn-warning" href="{{ route('video_schedule.edit', $row) }}">Edit</a>
                    <form method="POST" action="{{ route('video_schedule.destroy', $row) }}" class="d-inline" onsubmit="return confirm('Delete this schedule?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $schedules->links() }}
</div>
@endsection
