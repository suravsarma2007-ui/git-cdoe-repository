@extends('layouts.app')

@section('content')
<!-- All filter options are passed from the controller. No PHP logic here. -->
<div class="container-fluid">
  @if(session('success'))
    <script>
      window.onload = function() {
        alert(@json(session('success')));
      }
    </script>
  @endif
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Target Final Report</h4>
    <a class="btn btn-outline-primary" href="{{ route('target.finalReportCsv', request()->except('page')) }}">Export CSV</a>
  </div>
  <form method="GET" action="" class="card shadow-sm mb-3">
    <div class="card-body">
      <div class="row g-3">
                <div class="col-12 col-md-2">
                  <label class="form-label">Module No</label>
                  <select name="module_id" class="form-select">
                    <option value="">All</option>
                    @foreach($moduleOptions as $module)
                      <option value="{{ $module }}" {{ request('module_id') == $module ? 'selected' : '' }}>{{ $module }}</option>
                    @endforeach
                  </select>
                </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Program Name</label>
          <select name="program" class="form-select">
            <option value="">All</option>
            @foreach($programOptions as $prog)
              <option value="{{ $prog }}" {{ request('program') == $prog ? 'selected' : '' }}>{{ $prog }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Paper</label>
          <select name="PaperName" class="form-select">
            <option value="">All</option>
            @foreach($paperOptions as $paper)
              <option value="{{ $paper }}" {{ request('PaperName') == $paper ? 'selected' : '' }}>{{ $paper }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Faculty Name</label>
          <select name="name" class="form-select">
            <option value="">All</option>
            @foreach($facultyOptions as $faculty)
              <option value="{{ $faculty }}" {{ request('name') == $faculty ? 'selected' : '' }}>{{ $faculty }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="">All</option>
            @foreach($statusOptions as $st)
              <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">From Date</label>
          <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">To Date</label>
          <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
        </div>
      </div>
      <div class="mt-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Apply Filters</button>
        <a href="{{ route('target.finalReport') }}" class="btn btn-secondary">Reset</a>
      </div>
    </div>
  </form>
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0 align-middle">
          <thead class="table-light">
            <tr>
              <th>Sl No</th>
              <th>Emp ID</th>
              <th>Name</th>
              <th>Program ID</th>
              <th>Program</th>
              <th>Paper ID</th>
              <th>Paper Name</th>
              <th>Module ID</th>
              <th>Week ID</th>
              <th>From Date</th>
              <th>To Date</th>
              <th>Status</th>              
              <th>Remark</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>ESLM</th>
              <th>ESLM Submitted Date</th>
              <th>PPT</th>
              <th>PPT Submitted Date</th>
              <th>Video Required</th>
              <th>Vedio Submitted</th>
              <th>Vidoe Submitted Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($rows as $row)
              <tr>
                <td>{{ $row->slno ?? '' }}</td>
                <td>{{ $row->emp_id ?? '' }}</td>
                <td>{{ $row->name ?? '' }}</td>
                <td>{{ $row->program_id ?? '' }}</td>
                <td>{{ $row->program ?? '' }}</td>
                <td>{{ $row->paper_id ?? '' }}</td>
                <td>{{ $row->PaperName ?? '' }}</td>
                <td>{{ $row->module_id ?? '' }}</td>
                <td>{{ $row->week_id ?? '' }}</td>
                <td>{{ !empty($row->from_date) ? \Carbon\Carbon::parse($row->from_date)->format('Y-m-d') : '' }}</td>
                <td>{{ !empty($row->to_date) ? \Carbon\Carbon::parse($row->to_date)->format('Y-m-d') : '' }}</td>
                 <td>{{ $row->status ?? '' }}</td>               
                <td>{{ $row->remark ?? '' }}</td>
                <td>{{ !empty($row->created_at) ? \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i') : '' }}</td>
                <td>{{ !empty($row->updated_at) ? \Carbon\Carbon::parse($row->updated_at)->format('Y-m-d H:i') : '' }}</td>
                <td>{{ $row->ESLM ?? '' }}</td>
                <td>{{ !empty($row->ElsmSubmittedDate) ? \Carbon\Carbon::parse($row->ElsmSubmittedDate)->format('Y-m-d') : '' }}</td>
                <td>{{ $row->PPT ?? '' }}</td>
                <td>{{ !empty($row->PPTSubmittedDate) ? \Carbon\Carbon::parse($row->PPTSubmittedDate)->format('Y-m-d') : '' }}</td>
                <td>{{ $row->VideoRequired ?? '' }}</td>
                <td>{{ $row->VedioSubmitted ?? '' }}</td>
                <td>{{ !empty($row->VidoeSubmittedDate) ? \Carbon\Carbon::parse($row->VidoeSubmittedDate)->format('Y-m-d') : '' }}</td>
                 <td>
                  <form method="POST" action="{{ route('target.finalReport.update', $row->slno) }}" class="d-flex align-items-center gap-1">
                    @csrf
                    <select name="status" class="form-select form-select-sm" style="min-width: 120px; max-width: 200px;">
                      @foreach($statusOptions as $st)
                        <option value="{{ $st }}" {{ $row->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                      @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="22" class="text-center py-4">No records found.</td>
              </tr>
            @endforelse
          </tbody>
        </tbody>
      </table>
    </div>
    <div class="p-3">
      {{ $rows->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

@endsection
              </tr>

