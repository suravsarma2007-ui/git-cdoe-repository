@extends('layouts.app')

@section('title', 'Daily Record Video List')

@section('content')

<div class="container">
    <h4 class="mb-3">Daily Record Video Records</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Program</th>
                <th>Module</th>
                <th>Paper</th>
                <th>Faculty</th>
                <th>Editor</th>
                <th width="130">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($records as $row)
            <tr>
                <td>{{ $row->id }}</td>

                <td>{{ $programs[$row->program_id] ?? '-' }}</td>

                <td>{{ $modules[$row->module_id] ?? '-' }}</td>

                <td>{{ $papers[$row->paper_id] ?? '-' }}</td>

                <td>{{ $staffs[$row->faculty_id] ?? '-' }}</td>

                <td>{{ $staffs[$row->editor_emp_id] ?? '-' }}</td>

                <td>
                    <!-- Edit -->
                    <a href="{{ route('daily_record_video.edit', $row->id) }}"
                       class="btn btn-sm btn-primary">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('daily_record_video.delete', $row->id) }}"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this record?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    No records found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection


