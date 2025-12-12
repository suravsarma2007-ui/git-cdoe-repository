@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Create Academic Session</h4>
    <form method="POST" action="{{ route('academic_session.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Session ID <span class="text-danger">*</span></label>
            <input type="text" name="session_id" value="{{ old('session_id') }}" class="form-control @error('session_id') is-invalid @enderror" required>
            @error('session_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Session Name <span class="text-danger">*</span></label>
            <input type="text" name="session_name" value="{{ old('session_name') }}" class="form-control @error('session_name') is-invalid @enderror" required>
            @error('session_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Session Year <span class="text-danger">*</span></label>
            <input type="text" name="session_year" value="{{ old('session_year') }}" class="form-control @error('session_year') is-invalid @enderror" required>
            @error('session_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-link" href="{{ route('academic_session.index') }}">Cancel</a>
    </form>
</div>
@endsection