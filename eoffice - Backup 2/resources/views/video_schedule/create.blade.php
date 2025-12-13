@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Create Video Recording Schedule</h4>
    <form method="POST" action="{{ route('video_schedule.store') }}" class="row g-3">
        @csrf
        <div class="col-md-3">
            <label class="form-label">Faculty Name</label>
            <select name="emp_id" class="form-select" required>
                <option value="">Select Faculty</option>
                @foreach($faculties as $f)
                    <option value="{{ $f->id }}">{{ $f->name }} ({{ $f->emp_id }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Program</label>
            <select name="program_id" id="program_id" class="form-select" required>
                <option value="">Select Program</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}">{{ $p->program_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Paper Name</label>
            <select name="paper_id" id="paper_id" class="form-select" required>
                <option value="">Select Paper</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Module No</label>
            <select name="module_id" class="form-select" required>
                <option value="">Select Module</option>
                @foreach($modules as $m)
                    <option value="{{ $m->slno }}">{{ $m->moduleNo ?? $m->moduleno ?? $m->module_no }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Week</label>
            <select name="week_id" class="form-select" required>
                <option value="">Select Week</option>
                @foreach($weeks as $w)
                    <option value="{{ $w->id }}">{{ $w->week_no }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Record Date</label>
            <input type="date" name="record_date" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">From Time</label>
            <input type="time" name="from_time" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">To Time</label>
            <input type="time" name="to_time" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control">
        </div>
        <div class="col-md-12">
            <label class="form-label">Remark</label>
            <textarea name="remark" class="form-control" rows="2"></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Save</button>
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
                    paperSelect.appendChild(opt);
                });
            })
            .catch(() => {
                paperSelect.innerHTML = '<option value="">Failed to load</option>';
            });
    }

    programSelect.addEventListener('change', function() {
        const pid = this.value;
        if (pid) {
            loadPapers(pid);
        } else {
            paperSelect.innerHTML = '<option value="">Select Paper</option>';
            // No module filtering; leave as full list
        }
    });
});
</script>
@endsection
