@extends('layouts.app')

@section('title', 'Edit Allocation - eOffice')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="mb-4">Edit Paper Allocation</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('paper_allocation.update', $allocation) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="emp_id" class="form-label">Faculty <span class="text-danger">*</span></label>
                        <select name="emp_id" id="emp_id" class="form-select @error('emp_id') is-invalid @enderror" required>
                            <option value="">-- Select Faculty --</option>
                            @foreach($staff as $s)
                                <option value="{{ $s->id }}" {{ old('emp_id', $allocation->emp_id) == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->emp_id }})</option>
                            @endforeach
                        </select>
                        @error('emp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="program_select" class="form-label">Program</label>
                        <select id="program_select" class="form-select mb-2">
                            <option value="">-- Select Program (optional) --</option>
                            @foreach($programs as $prog)
                                <option value="{{ $prog->id }}" {{ optional($allocation->paper->program)->id == $prog->id ? 'selected' : '' }}>{{ $prog->program_name }} ({{ $prog->program_id }})</option>
                            @endforeach
                        </select>

                        <label for="paper_id" class="form-label">Paper <span class="text-danger">*</span></label>
                        <select name="paper_id" id="paper_id" class="form-select @error('paper_id') is-invalid @enderror" required>
                            <option value="">-- Select Paper --</option>
                            @foreach($papers as $p)
                                <option value="{{ $p->id }}" data-program="{{ $p->program->id ?? '' }}" {{ old('paper_id', $allocation->paper_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->paper_name }} ({{ $p->codes }}) - {{ $p->program->program_name ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('paper_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="module_no" class="form-label">Module No</label>
                            <input type="text" name="module_no" id="module_no" class="form-control" value="{{ old('module_no', $allocation->module_no) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select name="semester" id="semester" class="form-select" required>
                                <option value="">-- Select --</option>
                                @for($i=1;$i<=8;$i++)
                                    <option value="{{ $i }}" {{ old('semester', $allocation->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="year" class="form-label">Year (YYYY) <span class="text-danger">*</span></label>
                            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $allocation->year) }}" required min="1900" max="2100">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="week_no" class="form-label">Week No <span class="text-danger">*</span></label>
                            <select name="week_no" id="week_no" class="form-select" required>
                                <option value="">-- Select Week --</option>
                                @for($w=1;$w<=53;$w++)
                                    <option value="{{ $w }}" {{ old('week_no', $allocation->week_no) == $w ? 'selected' : '' }}>Week {{ $w }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $allocation->date?->toDateString()) }}" required>
                        </div>

                        <div class="col-md-4 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Update Allocation</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    (function(){
        const prog = document.getElementById('program_select');
        const paper = document.getElementById('paper_id');
        const initialSelected = @json(old('paper_id', $allocation->paper_id ?? null));
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
                    opt.textContent = `${p.paper_name} (${p.codes})${p.program_name ? ' - ' + p.program_name : ''}`;
                    paper.appendChild(opt);
                });

                if(initialSelected) {
                    paper.value = initialSelected;
                }
            } catch (e) {
                console.error('Failed to load papers', e);
            }
        }

        prog.addEventListener('change', function(){ loadPapers(this.value); });
        document.addEventListener('DOMContentLoaded', function(){ loadPapers(prog.value); });
    })();
</script>
@endsection
@endsection
