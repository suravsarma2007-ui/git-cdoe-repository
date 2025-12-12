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
                <option value="">-- Select Program --</option>
                @foreach($programs as $prog)
                    <option value="{{ $prog->id }}" {{ $ppt->program_id == $prog->id ? 'selected' : '' }}>{{ $prog->program_name }} ({{ $prog->program_id }})</option>
                @endforeach
            </select>

            <label for="paper_id" class="form-label">Paper <span class="text-danger">*</span></label>
            <select name="paper_id" id="paper_id" class="form-select @error('paper_id') is-invalid @enderror" required>
                <option value="">-- Select Paper --</option>
                @foreach($papers as $p)
                    <option value="{{ $p->id }}" data-program="{{ $p->program->id ?? '' }}" {{ old('paper_id', $ppt->paper_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->paper_name }} ({{ $p->codes }}) - {{ $p->program->program_name ?? '' }}
                    </option>
                @endforeach
            </select>
            @error('paper_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        @section('scripts')
        <script>
            (function(){
                const prog = document.getElementById('program_select');
                const paper = document.getElementById('paper_id');
                const initialSelected = @json($ppt->paper_id);
                const baseUrl = "{{ url('paper/by-program') }}";

                async function loadPapers(programId){
                    try {
                        const url = programId ? `${baseUrl}/${programId}` : baseUrl;
                        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                        if(!res.ok) return;
                        const data = await res.json();

                        paper.innerHTML = '<option value="">-- Select Paper --</option>';
                        data.forEach(p => {
                            const opt = document.createElement('option');
                            opt.value = p.id;
                            opt.textContent = `${p.paper_name} (${p.codes})`;
                            paper.appendChild(opt);
                        });

                        // Restore previous selection if present
                        if(initialSelected) {
                            paper.value = initialSelected;
                        }
                    } catch (e) {
                        paper.innerHTML = '<option value="">Error loading papers</option>';
                    }
                }
                // Ensure selection is restored after program change
                prog.addEventListener('change', function(){
                    loadPapers(this.value);
                    setTimeout(function(){
                        if(initialSelected) paper.value = initialSelected;
                    }, 300);
                });

                prog.addEventListener('change', function(){ loadPapers(this.value); });
                document.addEventListener('DOMContentLoaded', function(){
                    // Ensure program dropdown is set to the correct value
                    prog.value = @json($ppt->program_id);
                    loadPapers(prog.value);
                });

                // Auto-update Total field (No of PPT + Screen Recording)
                const noOfPpt = document.getElementById('no_of_ppt');
                const screenRecording = document.getElementById('screen_recording');
                const total = document.getElementById('total');
                function updateTotal() {
                    const n = parseInt(noOfPpt.value) || 0;
                    const s = parseInt(screenRecording.value) || 0;
                    total.value = n + s;
                }
                noOfPpt.addEventListener('input', updateTotal);
                screenRecording.addEventListener('input', updateTotal);
                document.addEventListener('DOMContentLoaded', updateTotal);
            })();
        </script>
        @endsection
        <div class="mb-3">
            <label for="emp_id" class="form-label">Faculty Name</label>
            <select id="emp_id" name="emp_id" class="form-select" required>
                <option value="">Select Faculty</option>
                @foreach($staff as $s)
                    <option value="{{ $s->id }}" {{ old('emp_id', $ppt->emp_id) == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->emp_id }})</option>
                @endforeach
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
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('ppt.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
