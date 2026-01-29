@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add PPT Record</h2>
    <form method="POST" action="{{ route('ppt.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="program_select" class="form-label">Program</label>
            <select id="program_select" name="program_id" class="form-select mb-2" required>
                <option value="">-- Select Program (optional) --</option>
                @foreach($programs as $prog)
                    <option value="{{ $prog->id }}">{{ $prog->program_name }} ({{ $prog->program_id }})</option>
                @endforeach
            </select>

            <label for="paper_id" class="form-label">Paper <span class="text-danger">*</span></label>
            <select name="paper_id" id="paper_id" class="form-select" required>
                <option value="">-- Select Paper --</option>
                @foreach($papers as $p)
                    <option value="{{ $p->id }}" data-program="{{ $p->program->id ?? '' }}">
                        {{ $p->paper_name }} ({{ $p->codes }}) - {{ $p->program->program_name ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="emp_id" class="form-label">Faculty Name</label>
            <select id="emp_id" name="emp_id" class="form-select" required>
                <option value="">Select Faculty</option>
                @foreach($staff as $s)
                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->emp_id }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="module_no" class="form-label">Module No</label>
            <input type="number" class="form-control" id="module_no" name="module_no" min="1" max="20" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
                <option value="Done and Upload">Done and Upload</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="no_of_ppt" class="form-label">No of PPT</label>
            <input type="number" class="form-control" id="no_of_ppt" name="no_of_ppt">
        </div>
        <div class="mb-3">
            <label for="screen_recording" class="form-label">Screen Recording</label>
            <input type="text" class="form-control" id="screen_recording" name="screen_recording">
        </div>
        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks"></textarea>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total">
        </div>
        <div class="mb-3">
            <label for="date_of_submit" class="form-label">Date Of Submit</label>
            <input type="date" class="form-control" id="date_of_submit" name="date_of_submit" value="{{ date('Y-m-d') }}" readonly>
        </div>
        <div class="mb-3">
            <label for="ppt_file_link" class="form-label">Upload PPT File (optional)</label>
            <input type="file" class="form-control" id="ppt_file_link" name="ppt_file_link" accept=".ppt,.pptx,.pdf">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('ppt.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@push('scripts')
<script>
    (function(){
        const prog = document.getElementById('program_select');
        const paper = document.getElementById('paper_id');
        const allOptions = Array.from(paper.options).slice(1); // skip placeholder
        function filterPapers(val) {
            paper.innerHTML = '<option value="">-- Select Paper --</option>';
            allOptions.forEach(opt => {
                if(!val || opt.getAttribute('data-program') === val) {
                    paper.appendChild(opt.cloneNode(true));
                }
            });
        }
        prog.addEventListener('change', function(){
            filterPapers(this.value);
        });
        // On page load, filter by selected program (if any)
        document.addEventListener('DOMContentLoaded', function(){
            filterPapers(prog.value);
        });
    })();
</script>
@endpush
@endsection
