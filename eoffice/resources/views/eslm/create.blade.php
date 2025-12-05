@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add ESLM Record</h2>
    <form method="POST" action="{{ route('eslm.store') }}" enctype="multipart/form-data">
                <!-- File upload moved to bottom and is optional -->
        @csrf
        <div class="mb-3">
            <label for="program_db_id" class="form-label">Program Name</label>
            <select id="program_db_id" name="program_db_id" class="form-select" required>
                <option value="">Select Program</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}" data-program_id="{{ $program->program_id }}">{{ $program->program_name }}</option>
                @endforeach
            </select>
            <input type="hidden" id="program_id" name="program_id">
        </div>
        <div class="mb-3">
            <label for="codes" class="form-label">Paper Name</label>
            <select id="codes" name="codes" class="form-select" required>
                <option value="">Select Paper</option>
            </select>
        </div>
                <div class="mb-3">
                    <label for="module_no" class="form-label">Module No</label>
                    <input type="number" class="form-control" id="module_no" name="module_no" min="1" max="20" required>
                </div>
        <div class="mb-3">
            <label for="emp_id" class="form-label">Faculty Name</label>
            <select id="emp_id" name="emp_id" class="form-select" required>
                <option value="">Select Faculty</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
                <option value="Done and Uploaded">Done and Uploaded</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="remark" class="form-label">Remark</label>
            <textarea class="form-control" id="remark" name="remark"></textarea>
        </div>
        <div class="mb-3">
            <label for="block" class="form-label">Block</label>
            <input type="text" class="form-control" id="block" name="block" maxlength="100" value="0">
        </div>
        <div class="mb-3">
            <label for="file_upload_link" class="form-label">Upload File (optional)</label>
            <input type="file" class="form-control" id="file_upload_link" name="file_upload_link" accept=".pdf,.doc,.docx,.zip">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('eslm.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
// Dynamic Paper and Faculty dropdowns
const programSelect = document.getElementById('program_db_id');
const paperSelect = document.getElementById('codes');
const facultySelect = document.getElementById('emp_id');
programSelect.addEventListener('change', function() {
    // Set hidden program_id (string) for backend compatibility
    const selected = this.options[this.selectedIndex];
    document.getElementById('program_id').value = selected.getAttribute('data-program_id');
    fetch(`/paper/by-program/${this.value}`)
        .then(res => res.json())
        .then(data => {
            paperSelect.innerHTML = '<option value="">Select Paper</option>';
            data.forEach(paper => {
                paperSelect.innerHTML += `<option value="${paper.codes}">${paper.paper_name}</option>`;
            });
        });
});
// Load only faculty (staff_type=Faculty)
window.addEventListener('DOMContentLoaded', function() {
    fetch('/staff/faculty-only')
        .then(res => res.json())
        .then(data => {
            facultySelect.innerHTML = '<option value="">Select Faculty</option>';
            data.forEach(staff => {
                facultySelect.innerHTML += `<option value="${staff.emp_id}">${staff.name}</option>`;
            });
        });
});
// No file upload fields for modules
</script>
@endsection
