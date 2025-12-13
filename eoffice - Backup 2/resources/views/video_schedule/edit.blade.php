@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Edit Video Recording Schedule</h4>
    <form method="POST" action="{{ route('video_schedule.update', $video_schedule) }}" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-3">
            <label class="form-label">Faculty Name</label>
            <select name="emp_id" class="form-select" required>
                @foreach($faculties as $f)
                    <option value="{{ $f->id }}" @selected($video_schedule->emp_id == $f->id)>{{ $f->name }} ({{ $f->emp_id }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Program</label>
            <select name="program_id" id="program_id" class="form-select" required>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" @selected($video_schedule->program_id == $p->id)>{{ $p->program_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Paper Name</label>
            <select name="paper_id" id="paper_id" class="form-select" required>
                @foreach($papers as $paper)
                    <option value="{{ $paper->id }}" @selected($video_schedule->paper_id == $paper->id)>{{ $paper->paper_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Module No</label>
            <select name="module_id" class="form-select" required>
                @foreach($modules as $m)
                    <option value="{{ $m->slno }}" @selected($video_schedule->module_id == $m->slno)>{{ $m->moduleNo ?? $m->moduleno ?? $m->module_no }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Week</label>
            <select name="week_id" class="form-select" required>
                @foreach($weeks as $w)
                    <option value="{{ $w->id }}" @selected($video_schedule->week_id == $w->id)>{{ $w->week_no }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Record Date</label>
            <input type="date" name="record_date" class="form-control" value="{{ $video_schedule->record_date }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">From Time</label>
            <input type="time" name="from_time" class="form-control" value="{{ $video_schedule->from_time }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">To Time</label>
            <input type="time" name="to_time" class="form-control" value="{{ $video_schedule->to_time }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $video_schedule->status }}">
        </div>
        <div class="col-md-12">
            <label class="form-label">Remark</label>
            <textarea name="remark" class="form-control" rows="2">{{ $video_schedule->remark }}</textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Update</button>
            <a class="btn btn-link" href="{{ route('video_schedule.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const programSelect = document.getElementById('program_id');
    const paperSelect = document.getElementById('paper_id');
    const selectedPaperId = '{{ $video_schedule->paper_id }}';

    function loadPapers(programId) {
        paperSelect.innerHTML = '<option value="">Loading...</option>';
        const url = '{{ route('video_schedule.papersByProgram') }}' + '?program_id=' + encodeURIComponent(programId);
        fetch(url, { headers: { 'Accept': 'application/json' }})
            .then(res => res.json())
            .then(items => {
                paperSelect.innerHTML = '<option value="">Select Paper</option>';
                items.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.paper_name;
                    if (String(p.id) === String(selectedPaperId)) opt.selected = true;
                    paperSelect.appendChild(opt);
                });
            })
            .catch(() => {
                paperSelect.innerHTML = '<option value="">Failed to load</option>';
            });
    }

    // Initial load in case the program changes and to ensure consistency
    if (programSelect.value) {
        loadPapers(programSelect.value);
    }

    // No module filtering; modules list remains static

    programSelect.addEventListener('change', function() {
        const pid = this.value;
        if (pid) {
            loadPapers(pid);
        } else {
            paperSelect.innerHTML = '<option value="">Select Paper</option>';
        }
    });
});
</script>
@endsection
