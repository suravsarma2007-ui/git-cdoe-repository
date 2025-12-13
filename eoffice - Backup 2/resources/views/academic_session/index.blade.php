@extends('layouts.app')

@section('title', 'Add Paper - eOffice')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Academic Sessions</h4>
        <a class="btn btn-primary" href="{{ route('academic_session.create') }}">Create Session</a>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Session ID</th>
                <th>Session Name</th>
                <th>Session Year</th>
                <th style="width:160px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($sessions as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->session_id }}</td>
                <td>{{ $s->session_name }}</td>
                <td>{{ $s->session_year }}</td>
                <td>
                    <a href="{{ route('academic_session.edit', $s) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('academic_session.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this session?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">No sessions found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $sessions->links() }}
</div>
@endsection