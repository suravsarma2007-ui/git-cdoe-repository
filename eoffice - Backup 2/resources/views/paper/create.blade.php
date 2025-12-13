@extends('layouts.app')

@section('title', 'Add Paper - eOffice')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="mb-4">Add New Paper</h2>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Paper Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('paper.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program <span class="text-danger">*</span></label>
                        <select class="form-select @error('program_id') is-invalid @enderror" 
                                id="program_id" name="program_id" required>
                            <option value="">-- Select Program --</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->program_name }} ({{ $program->program_id }})
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="codes" class="form-label">Paper Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('codes') is-invalid @enderror" 
                               id="codes" name="codes" value="{{ old('codes') }}" placeholder="e.g., CS101" required>
                        @error('codes')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="paper_name" class="form-label">Paper Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('paper_name') is-invalid @enderror" 
                               id="paper_name" name="paper_name" value="{{ old('paper_name') }}" placeholder="e.g., Data Structures" required>
                        @error('paper_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <!-- Module field removed as it's not required -->

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select class="form-select @error('semester') is-invalid @enderror" 
                                    id="semester" name="semester" required>
                                <option value="">-- Select Semester --</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="years" class="form-label">Year <span class="text-danger">*</span></label>
                            <select class="form-select @error('years') is-invalid @enderror" 
                                    id="years" name="years" required>
                                <option value="">-- Select Year --</option>
                                @for ($i = 2025; $i <= 2035; $i++)
                                    <option value="{{ $i }}" {{ old('') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('years')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Save Paper
                        </button>
                        <a href="{{ route('paper.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
