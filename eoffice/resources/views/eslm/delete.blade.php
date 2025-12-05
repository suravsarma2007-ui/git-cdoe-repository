@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Delete ESLM Record</h2>
    <div class="alert alert-danger">Are you sure you want to delete this record?</div>
    <form method="POST" action="{{ route('eslm.confirm-delete', $eslm->id) }}">
        @csrf
        @method('DELETE')
        <table class="table table-bordered">
            <tr><th>Program Name</th><td>{{ $eslm->program->program_name ?? $eslm->program_id }}</td></tr>
            <tr><th>Paper Name</th><td>{{ $eslm->paper->paper_name ?? $eslm->paper_code }}</td></tr>
            <tr><th>Faculty Name</th><td>{{ $eslm->staff->name ?? $eslm->emp_id }}</td></tr>
            <tr><th>Module No</th><td>{{ $eslm->module_no }}</td></tr>
            <tr><th>Status</th><td>{{ $eslm->status }}</td></tr>
            <tr><th>Date Of Submit</th><td>{{ $eslm->date_of_submit }}</td></tr>
            <tr><th>File</th><td>@if($eslm->file_upload_link)<a href="{{ asset('storage/' . $eslm->file_upload_link) }}" target="_blank">Download</a>@endif</td></tr>
            <tr><th>Remark</th><td>{{ $eslm->remark }}</td></tr>
            <tr><th>Block</th><td>{{ $eslm->block }}</td></tr>
        </table>
        <button type="submit" class="btn btn-danger">Yes, Delete Permanently</button>
        <a href="{{ route('eslm.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
