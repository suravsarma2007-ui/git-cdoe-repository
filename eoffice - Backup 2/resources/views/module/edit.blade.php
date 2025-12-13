@extends('layouts.app')

@section('title', 'Edit Module')

@section('content')
<div class="container">
    <h4>Edit Module</h4>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ route('module.update', $module) }}">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Module No <span class="text-danger">*</span></label>
                <input type="number" name="moduleNo" min="1" class="form-control @error('moduleNo') is-invalid @enderror" value="{{ old('moduleNo', $module->moduleNo ?? '') }}" required>
                @error('moduleNo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary" type="submit">Update</button>
            <a class="btn btn-link" href="{{ route('module.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection
