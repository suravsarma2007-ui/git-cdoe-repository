@extends('layouts.app')

@section('title', 'Edit Staff - eOffice')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="mb-4">Edit Staff Member</h2>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $staff->name }} ({{ $staff->emp_id }})</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('staff.update', $staff) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="emp_id" class="form-label">Employee ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('emp_id') is-invalid @enderror" 
                                   id="emp_id" name="emp_id" value="{{ old('emp_id', $staff->emp_id) }}" required>
                            @error('emp_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $staff->name) }}" required>
                            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                   id="designation" name="designation" value="{{ old('designation', $staff->designation) }}" required>
                            @error('designation')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="staff_type" class="form-label">Staff Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('staff_type') is-invalid @enderror" 
                                    id="staff_type" name="staff_type" required>
                                <option value="">-- Select Staff Type --</option>
                                <option value="Faculty" {{ old('staff_type', $staff->staff_type) === 'Faculty' ? 'selected' : '' }}>Faculty</option>
                                <option value="Non-Teaching" {{ old('staff_type', $staff->staff_type) === 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                                <option value="Support" {{ old('staff_type', $staff->staff_type) === 'Support' ? 'selected' : '' }}>Support</option>
                            </select>
                            @error('staff_type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="discipline" class="form-label">Discipline</label>
                            <input type="text" class="form-control @error('discipline') is-invalid @enderror" 
                                   id="discipline" name="discipline" value="{{ old('discipline', $staff->discipline) }}">
                            @error('discipline')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                   id="subject" name="subject" value="{{ old('subject', $staff->subject) }}">
                            @error('subject')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="official_email" class="form-label">Official Email</label>
                            <input type="email" class="form-control @error('official_email') is-invalid @enderror" 
                                   id="official_email" name="official_email" value="{{ old('official_email', $staff->official_email) }}">
                            @error('official_email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="personal_email" class="form-label">Personal Email</label>
                            <input type="email" class="form-control @error('personal_email') is-invalid @enderror" 
                                   id="personal_email" name="personal_email" value="{{ old('personal_email', $staff->personal_email) }}">
                            @error('personal_email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                   id="contact" name="contact" value="{{ old('contact', $staff->contact) }}" maxlength="20">
                            @error('contact')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="doj" class="form-label">Date of Joining <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('doj') is-invalid @enderror" 
                                   id="doj" name="doj" value="{{ old('doj', $staff->doj->format('Y-m-d')) }}" required>
                            @error('doj')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3">{{ old('address', $staff->address) }}</textarea>
                        @error('address')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Staff Member
                        </button>
                        <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
