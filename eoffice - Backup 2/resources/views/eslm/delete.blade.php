@extends('layouts.app')
@section('title', 'Delete ESLM Record')
@section('content')
<div class="container">
    <h2>Delete ESLM Record</h2>
    <div class="alert alert-danger">Are you sure you want to delete this record?</div>
    <form method="POST" action="{{ route('eslm.destroy', $eslm->id) }}">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <strong>Program:</strong> {{ $eslm->program?->program_name }}<br>
            <strong>Paper:</strong> {{ $eslm->paper?->paper_name }}<br>
            <strong>Faculty:</strong> {{ $eslm->staff?->name }}<br>
            <strong>Module No:</strong> {{ $eslm->module_no }}<br>
            <strong>Status:</strong> {{ $eslm->status }}<br>
            <strong>Date of Submit:</strong> {{ $eslm->date_of_submit }}<br>
            <strong>Remark:</strong> {{ $eslm->remark }}<br>
            <strong>Block:</strong> {{ $eslm->block }}<br>
        </div>
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('eslm.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
