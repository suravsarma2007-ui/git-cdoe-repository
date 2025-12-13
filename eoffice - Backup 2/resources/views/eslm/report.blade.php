@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ESLM Report</h1>

    <form method="GET" action="">
        <div class="row mb-3">
            <div class="col">
                <select name="program_id" class="form-control">
                    <option value="">All Programs</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>{{ $program->program_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="paper_id" class="form-control">
                    <option value="">All Papers</option>
                    @foreach($papers as $paper)
                        <option value="{{ $paper->id }}" {{ request('paper_codes') == $paper->id ? 'selected' : '' }}>{{ $paper->paper_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="emp_id" class="form-control">
                    <option value="">All Faculty</option>
                    @foreach($staff as $faculty)
                        <option value="{{ $faculty->emp_id }}" {{ request('emp_id') == $faculty->emp_id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="module_no" class="form-control" placeholder="Module No" value="{{ request('module_no') }}">
            </div>
            <div class="col">
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Uploaded" {{ request('status') == 'Uploaded' ? 'selected' : '' }}>Uploaded</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Program</th>
                <th>Paper Name</th>
                <th>Faculty</th>
                <th>Module No</th>
                <th>Status</th>
                <th>Date of Submit</th>
                <th>File Link</th>
                <th>Remark</th>
                <th>Block</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eslms as $i => $eslm)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $eslm->program->program_name ?? '' }}</td>
                <td>{{ $eslm->paper ? $eslm->paper->paper_name : '' }}</td>
                <td>{{ $eslm->staff->name ?? '' }}</td>
                <td>{{ $eslm->module_no }}</td>
                <td>{{ $eslm->status }}</td>
                <td>{{ $eslm->date_of_submit }}</td>
                <td>
                    @if($eslm->file_upload_link)
                        <a href="{{ asset('storage/' . $eslm->file_upload_link) }}" target="_blank">View</a>
                    @endif
                </td>
                <td>{{ $eslm->remark }}</td>
                <td>{{ $eslm->block }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
