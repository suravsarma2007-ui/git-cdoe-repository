@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Add New Video Entry</h2>

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('video.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="program_id" class="form-label">Program Name <span class="text-danger">*</span></label>
                            <select name="program_id" id="program_id" class="form-select @error('program_id') is-invalid @enderror" required>
                                <option value="">Select Program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" @selected(old('program_id') == $program->id)>
                                        {{ $program->program_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select name="semester" id="semester" class="form-select @error('semester') is-invalid @enderror" required>
                                <option value="">Select Semester</option>
                            </select>
                            @error('semester') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="paper_id" class="form-label">Paper Name <span class="text-danger">*</span></label>
                            <select name="paper_id" id="paper_id" class="form-select @error('paper_id') is-invalid @enderror" required>
                                <option value="">Select Paper</option>
                            </select>
                            @error('paper_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="emp_id" class="form-label">Staff Name <span class="text-danger">*</span></label>
                            <select name="emp_id" id="emp_id" class="form-select @error('emp_id') is-invalid @enderror" required>
                                <option value="">Select Staff</option>
                                @foreach($staff as $member)
                                    <option value="{{ $member->id }}" @selected(old('emp_id') == $member->id)>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('emp_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="module_no" class="form-label">Module No</label>
                            <input type="text" name="module_no" id="module_no" class="form-control @error('module_no') is-invalid @enderror" value="{{ old('module_no') }}">
                            @error('module_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_videos_required" class="form-label">Total Videos Required <span class="text-danger">*</span></label>
                            <input type="number" name="total_videos_required" id="total_videos_required" class="form-control @error('total_videos_required') is-invalid @enderror" value="{{ old('total_videos_required', 0) }}" min="0" required>
                            @error('total_videos_required') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_videos_done" class="form-label">Total Videos Done <span class="text-danger">*</span></label>
                            <input type="number" name="total_videos_done" id="total_videos_done" class="form-control @error('total_videos_done') is-invalid @enderror" value="{{ old('total_videos_done', 0) }}" min="0" required>
                            @error('total_videos_done') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_videos_edited" class="form-label">Total Videos Edited <span class="text-danger">*</span></label>
                            <input type="number" name="total_videos_edited" id="total_videos_edited" class="form-control @error('total_videos_edited') is-invalid @enderror" value="{{ old('total_videos_edited', 0) }}" min="0" required>
                            @error('total_videos_edited') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="uploaded_videos" class="form-label">Uploaded Videos <span class="text-danger">*</span></label>
                            <input type="number" name="uploaded_videos" id="uploaded_videos" class="form-control @error('uploaded_videos') is-invalid @enderror" value="{{ old('uploaded_videos', 0) }}" min="0" required>
                            @error('uploaded_videos') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="upload_date" class="form-label">Upload Date <span class="text-danger">*</span></label>
                            <input type="date" name="upload_date" id="upload_date" class="form-control @error('upload_date') is-invalid @enderror" value="{{ old('upload_date', date('Y-m-d')) }}" required>
                            @error('upload_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea name="remark" id="remark" class="form-control @error('remark') is-invalid @enderror" rows="3">{{ old('remark') }}</textarea>
                            @error('remark') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="final_status" class="form-label">Final Status</label>
                            <select name="final_status" id="final_status" class="form-select @error('final_status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Pending" @selected(old('final_status') == 'Pending')>Pending</option>
                                <option value="In Progress" @selected(old('final_status') == 'In Progress')>In Progress</option>
                                <option value="Completed" @selected(old('final_status') == 'Completed')>Completed</option>
                                <option value="On Hold" @selected(old('final_status') == 'On Hold')>On Hold</option>
                            </select>
                            @error('final_status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Save Video Entry</button>
                            <a href="{{ route('video.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const programSelect = document.getElementById('program_id');
    const semesterSelect = document.getElementById('semester');
    const paperSelect = document.getElementById('paper_id');

    programSelect.addEventListener('change', async function() {
        const programId = this.value;
        semesterSelect.innerHTML = '<option value="">Select Semester</option>';
        paperSelect.innerHTML = '<option value="">Select Paper</option>';

        if (programId) {
            try {
                const response = await fetch(`/video/semesters-by-program/${programId}`);
                const semesters = await response.json();
                semesters.forEach(semester => {
                    const option = document.createElement('option');
                    option.value = semester;
                    option.textContent = semester;
                    semesterSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching semesters:', error);
            }
        }
    });

    semesterSelect.addEventListener('change', async function() {
        const programId = programSelect.value;
        const semester = this.value;
        paperSelect.innerHTML = '<option value="">Select Paper</option>';

        if (programId && semester) {
            try {
                const response = await fetch(`/video/papers-by-program-semester/${programId}/${semester}`);
                const papers = await response.json();
                papers.forEach(paper => {
                    const option = document.createElement('option');
                    option.value = paper.id;
                    option.textContent = paper.paper_name;
                    paperSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching papers:', error);
            }
        }
    });
</script>
@endsection
