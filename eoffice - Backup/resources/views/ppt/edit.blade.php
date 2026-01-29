@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit PPT Record</h2>
    <form method="POST" action="{{ route('ppt.update', $ppt->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="program_select" class="form-label">Program</label>
            <select id="program_select" name="program_id" class="form-select mb-2" required>
                <option value="">-- Select Program (optional) --</option>
                @foreach($programs as $prog)
                    <option value="{{ $prog->id }}" @if($ppt->program_id == $prog->id) selected @endif>{{ $prog->program_name }} ({{ $prog->program_id }})</option>
                @endforeach
            </select>

            <label for="paper_id" class="form-label">Paper <span class="text-danger">*</span></label>
            <select name="paper_id" id="paper_id" class="form-select" required>
                <option value="">-- Select Paper --</option>
            </select>
        </div>
        @push('scripts')
        <script>
            (function(){
                const prog = document.getElementById('program_select');
                const paper = document.getElementById('paper_id');
                async function loadPapers(programId, selectedPaperId = null) {
                    paper.innerHTML = '<option value="">-- Select Paper --</option>';
                    if (!programId) return;
                    try {
                        const res = await fetch(`/paper/by-program/${programId}`);
                        if (!res.ok) return;
                        const data = await res.json();
                        data.forEach(p => {
                            const opt = document.createElement('option');
                            opt.value = p.id;
                            opt.textContent = `${p.paper_name} (${p.codes ?? ''}) - ${p.program_name ?? ''}`;
                            if(selectedPaperId && selectedPaperId == p.id) opt.selected = true;
                            paper.appendChild(opt);
                        });
                    } catch (e) {
                        paper.innerHTML = '<option value="">Error loading papers</option>';
                    }
                }
                prog.addEventListener('change', function(){
                    loadPapers(this.value);
                });
                // On page load, filter by selected program and select current paper
                document.addEventListener('DOMContentLoaded', function(){
                    if(prog.value) loadPapers(prog.value, {{ $ppt->paper_id }});
                });
            })();
        </script>
        @endpush
        <div class="mb-3">
            <label for="emp_id" class="form-label">Faculty Name</label>
            <select id="emp_id" name="emp_id" class="form-select" required>
                <option value="">Select Faculty</option>
                <option value="{{ $ppt->emp_id }}" selected>{{ $ppt->staff->name ?? $ppt->emp_id }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="module_no" class="form-label">Module No</label>
            <input type="number" class="form-control" id="module_no" name="module_no" min="1" max="20" value="{{ $ppt->module_no }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Pending" @if($ppt->status==="Pending") selected @endif>Pending</option>
                <option value="Done" @if($ppt->status==="Done") selected @endif>Done</option>
                <option value="Done and Upload" @if($ppt->status==="Done and Upload") selected @endif>Done and Upload</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="no_of_ppt" class="form-label">No of PPT</label>
            <input type="number" class="form-control" id="no_of_ppt" name="no_of_ppt" value="{{ $ppt->no_of_ppt }}">
        </div>
        <div class="mb-3">
            <label for="screen_recording" class="form-label">Screen Recording</label>
            <input type="text" class="form-control" id="screen_recording" name="screen_recording" value="{{ $ppt->screen_recording }}">
        </div>
        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks">{{ $ppt->remarks }}</textarea>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" value="{{ $ppt->total }}">
        </div>
        <div class="mb-3">
            <label for="date_of_submit" class="form-label">Date Of Submit</label>
            <input type="date" class="form-control" id="date_of_submit" name="date_of_submit" value="{{ $ppt->date_of_submit }}" readonly>
        </div>
        <div class="mb-3">
            <label for="ppt_file_link" class="form-label">Upload PPT File (optional)</label>
            <input type="file" class="form-control" id="ppt_file_link" name="ppt_file_link" accept=".ppt,.pptx,.pdf">
            @if($ppt->ppt_file_link)
                <p>Current file: <a href="{{ asset('storage/' . $ppt->ppt_file_link) }}" target="_blank">View</a></p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('ppt.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
