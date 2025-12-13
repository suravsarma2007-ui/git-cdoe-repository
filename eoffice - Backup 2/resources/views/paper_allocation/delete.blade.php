@extends('layouts.app')

@section('title', 'Delete Allocation - eOffice')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="alert alert-danger">Confirm deletion of this allocation.</div>

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Paper:</strong> {{ $allocation->paper->paper_name ?? '-' }} ({{ $allocation->paper->codes ?? '-' }})</p>
                <p><strong>Faculty:</strong> {{ $allocation->staff->name ?? '-' }}</p>
                <p><strong>Semester:</strong> {{ $allocation->semester }}</p>
                <p><strong>Year:</strong> {{ $allocation->year }}</p>
                <p><strong>Week:</strong> {{ $allocation->week_no }}</p>
                <p><strong>Date:</strong> {{ $allocation->date?->toDateString() }}</p>
            </div>
        </div>

        <form action="{{ route('paper_allocation.confirm-delete', $allocation) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-danger">Yes, delete</button>
                <a href="{{ route('paper_allocation.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
