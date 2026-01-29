@extends('layouts.app')

@section('title', 'Add Program - eOffice')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="mb-4">Add New Program</h2>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Program Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('program.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="program_name" class="form-label">Program Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('program_name') is-invalid @enderror" 
                               id="program_name" name="program_name" value="{{ old('program_name') }}" required>
                        @error('program_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('program_id') is-invalid @enderror" 
                               id="program_id" name="program_id" value="{{ old('program_id') }}" placeholder="e.g., PROG001" required>
                        @error('program_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="session_year" class="form-label">Session Year <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('session_year') is-invalid @enderror" 
                               id="session_year" name="session_year" value="{{ old('session_year') }}" placeholder="e.g., 2024-25" required>
                        @error('session_year')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="program_code" class="form-label">Program Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('program_code') is-invalid @enderror" 
                               id="program_code" name="program_code" value="{{ old('program_code') }}" placeholder="e.g., BCA" required>
                        @error('program_code')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Save Program
                        </button>
                        <a href="{{ route('program.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
