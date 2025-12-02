@extends('layouts.app')

@section('title', 'Delete Paper - eOffice')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">
                <i class="bi bi-exclamation-triangle"></i> Delete Paper
            </h4>
            <p>Are you sure you want to delete this paper? This action cannot be undone.</p>
        </div>

        <div class="card border-danger mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Paper Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th style="width: 35%">Program:</th>
                        <td>
                            <span class="badge bg-success">{{ $paper->program->program_name }}</span>
                            ({{ $paper->program->program_id }})
                        </td>
                    </tr>
                    <tr>
                        <th>Paper Code:</th>
                        <td><strong>{{ $paper->codes }}</strong></td>
                    </tr>
                    <tr>
                        <th>Paper Name:</th>
                        <td>{{ $paper->paper_name }}</td>
                    </tr>
                    <tr>
                        <th>Module:</th>
                        <td>{{ $paper->module ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Semester:</th>
                        <td><span class="badge bg-warning">Semester {{ $paper->semester }}</span></td>
                    </tr>
                    <tr>
                        <th>Year:</th>
                        <td><span class="badge bg-info">Year {{ $paper->years }}</span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-center">
            <form action="{{ route('paper.destroy', $paper) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Delete Permanently
                </button>
            </form>
            <a href="{{ route('paper.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
        </div>
    </div>
</div>
@endsection
