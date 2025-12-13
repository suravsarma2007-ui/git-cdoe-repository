@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Confirm Delete</h4>
                </div>
                <div class="card-body">
                    <p class="mb-3">Are you sure you want to delete this video entry?</p>
                    
                    <div class="bg-light p-3 rounded mb-4">
                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Program:</strong></div>
                            <div class="col-md-8">{{ $video->program->program_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Paper:</strong></div>
                            <div class="col-md-8">{{ $video->paper->paper_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Staff:</strong></div>
                            <div class="col-md-8">{{ $video->staff->name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Module:</strong></div>
                            <div class="col-md-8">{{ $video->module_no ?? '-' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><strong>Upload Date:</strong></div>
                            <div class="col-md-8">{{ $video->upload_date?->toDateString() ?? '-' }}</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('video.confirm-delete', $video->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Permanently</button>
                        <a href="{{ route('video.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
