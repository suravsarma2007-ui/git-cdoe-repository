@extends('layouts.app')
@section('title', 'ESLM Report')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>ESLM Report</h2>
        <a href="{{ route('eslm.create') }}" class="btn btn-success">+ New ESLM Record</a>
    </div>
    <form method="GET" action="{{ route('eslm.index') }}" class="row g-3 mb-3">
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                @foreach($programs as $prog)
                    <option value="{{ $prog->id }}" {{ request('program_id') == $prog->program_id ? 'selected' : '' }}>{{ $prog->program_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="codes" class="form-select">
                <option value="">All Papers</option>
                @foreach($papers as $p)
                    <option value="{{ $p->id }}" {{ request('codes') == $p->id ? 'selected' : '' }}>{{ $p->paper_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="module_no" class="form-select">
                <option value="">All Modules</option>
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $i }}" {{ request('module_no') == $i ? 'selected' : '' }}>Module {{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2">
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                @foreach($staff as $s)
                    <option value="{{ $s->emp_id }}" {{ request('emp_id') == $s->emp_id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                <option value="Done & Uploaded" {{ request('status') == 'Done & Uploaded' ? 'selected' : '' }}>Done & Uploaded</option>
            </select>
        </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100 mb-2">Filter</button>
        <a href="{{ route('eslm.export-csv', request()->all()) }}" class="btn btn-info w-100">Download CSV</a>
    </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Program Name</th>
                    <th>Paper Name</th>
                    <th>Faculty Name</th>
                    <th>Module No</th>
                    <th>Status</th>
                    <th>Date of Submit</th>
                    <th>File Link</th>
                    <th>Remark</th>
                    <th>Block</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eslms as $row)               
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->program?->program_name }}</td>
                    <td>{{ $row->paper?->paper_name }}</td>
                    <td>{{ $row->staff?->name }}</td>
                    <td>{{ $row->module_no }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->date_of_submit }}</td>
                    <td>
                        @if($row->file_upload_link)
                            <a href="{{ asset('storage/' . $row->file_upload_link) }}" target="_blank">View</a>
                        @endif
                    </td>
                    <td>{{ $row->remark }}</td>
                    <td>{{ $row->block }}</td>
                    <td>
                        <a href="{{ route('eslm.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('eslm.delete', $row->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $eslms->withQueryString()->links() }}
    </div>
</div>
@endsection
