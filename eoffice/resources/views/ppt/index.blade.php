@extends('layouts.app')
@section('content')
<div class="container">
    <h2>PPT Report</h2>
    <form method="GET" action="{{ route('ppt.index') }}" class="row g-3 mb-3">
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                @foreach($programs as $program)
                    <option value="{{ $program->program_id }}" @if(request('program_id') == $program->program_id) selected @endif>{{ $program->program_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="paper" class="form-select">
                <option value="">All Papers</option>
                @foreach($papers as $paper)
                    <option value="{{ $paper->paper_name }}" @if(request('paper') == $paper->paper_name) selected @endif>{{ $paper->paper_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="module_no" class="form-control" placeholder="Module No" value="{{ request('module_no') }}">
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
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="Pending" @if(request('status') == 'Pending') selected @endif>Pending</option>
                <option value="Done" @if(request('status') == 'Done') selected @endif>Done</option>
                <option value="Done and Upload" @if(request('status') == 'Done and Upload') selected @endif>Done and Upload</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('ppt.create') }}" class="btn btn-primary">Create PPT</a>
        <a href="{{ route('ppt.exportCsv', request()->all()) }}" class="btn btn-success">Download CSV</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Program Name</th>
                <th>Semester</th>
                <th>Paper Name</th>
                <th>Module No</th>
                <th>Status</th>
                <th>No of PPT</th>
                <th>Screen Recording</th>
                <th>Remarks</th>
                <th>Total</th>
                <th>Date Of Submit</th>
                <th>PPT File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ppts as $ppt)
            <tr>
                <td>{{ $ppt->id }}</td>
                <td>{{ $ppt->program?->program_name }}</td>
                <td>{{ $ppt->paper()->first()?->semester }}</td>
                <td>{{ $ppt->paper }}</td>
                <td>{{ $ppt->module_no }}</td>
                <td>{{ $ppt->status }}</td>
                <td>{{ $ppt->no_of_ppt }}</td>
                <td>{{ $ppt->screen_recording }}</td>
                <td>{{ $ppt->remarks }}</td>
                <td>{{ $ppt->total }}</td>
                <td>{{ $ppt->date_of_submit }}</td>
                <td>
                    @if($ppt->ppt_file_link)
                        <a href="{{ asset('storage/' . $ppt->ppt_file_link) }}" target="_blank">View</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('ppt.edit', $ppt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('ppt.destroy', $ppt->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ppts->links() }}
</div>
@endsection
