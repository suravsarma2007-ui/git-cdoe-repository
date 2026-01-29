@extends('layouts.app')
@section('content')
<div class="container">
    <h2>ESLM Records</h2>
    <div class="mb-3">
        <a href="{{ route('eslm.create') }}" class="btn btn-success">Add New Record</a>
        <a href="{{ route('eslm.export-csv', request()->all()) }}" class="btn btn-info">Download CSV</a>
        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#importCsv">Import CSV</button>
    </div>
    <div class="collapse mb-3" id="importCsv">
        <form method="POST" action="{{ route('eslm.import-csv') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <input type="file" name="csv_file" class="form-control" required accept=".csv">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Upload CSV</button>
                </div>
            </div>
        </form>
    </div>
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                @foreach($programs as $program)
                    <option value="{{ $program->program_id }}" @if(request('program_id') == $program->program_id) selected @endif>{{ $program->program_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="paper_code" class="form-select">
                <option value="">All Papers</option>
                @foreach($papers as $paper)
                    <option value="{{ $paper->paper_code }}" @if(request('paper_code') == $paper->paper_code) selected @endif>{{ $paper->paper_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                @foreach($staff as $s)
                    <option value="{{ $s->emp_id }}" @if(request('emp_id') == $s->emp_id) selected @endif>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="module_no" class="form-control" placeholder="Module No" value="{{ request('module_no') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="status" class="form-control" placeholder="Status" value="{{ request('status') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SlNo</th>
                    <th>Program Name</th>
                    <th>Paper Name</th>
                    <th>Faculty Name</th>
                    <th>Module No</th>
                    <th>Status</th>
                    <th>Date Of Submit</th>
                    <th>File</th>
                    <th>Remark</th>
                    <th>Block</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eslms as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->program->program_name ?? $row->program_id }}</td>
                    <td>{{ $row->paper->paper_name ?? $row->paper_code }}</td>
                    <td>{{ $row->staff->name ?? $row->emp_id }}</td>
                    <td>{{ $row->module_no }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->date_of_submit }}</td>
                    <td>
                        @if($row->file_upload_link)
                            <a href="{{ asset('storage/' . $row->file_upload_link) }}" target="_blank">Download</a>
                        @endif
                    </td>
                    <td>{{ $row->remark }}</td>
                    <td>{{ $row->block }}</td>
                    <td>
                        <a href="{{ route('eslm.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('eslm.delete', $row->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')">Delete</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="11" class="text-center">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $eslms->withQueryString()->links() }}
    </div>
</div>
@endsection
