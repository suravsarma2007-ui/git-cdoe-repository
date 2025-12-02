@extends('layouts.app')

@section('title', 'Edit Program - eOffice')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="mb-4">Edit Program</h2>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $program->program_name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('program.update', $program) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="program_name" class="form-label">Program Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('program_name') is-invalid @enderror" 
                               id="program_name" name="program_name" value="{{ old('program_name', $program->program_name) }}" required>
                        @error('program_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('program_id') is-invalid @enderror" 
                               id="program_id" name="program_id" value="{{ old('program_id', $program->program_id) }}" required>
                        @error('program_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="session_year" class="form-label">Session Year <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('session_year') is-invalid @enderror" 
                               id="session_year" name="session_year" value="{{ old('session_year', $program->session_year) }}" required>
                        @error('session_year')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="program_code" class="form-label">Program Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('program_code') is-invalid @enderror" 
                               id="program_code" name="program_code" value="{{ old('program_code', $program->program_code) }}" required>
                        @error('program_code')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Program
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
