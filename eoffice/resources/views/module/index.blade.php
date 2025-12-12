@extends('layouts.app')

@section('title', 'Add Paper - eOffice')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Modules</h4>
        <a class="btn btn-primary" href="{{ route('module.create') }}">Create Module</a>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Module No</th>
                <th style="width:160px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($modules as $m)
            <tr>
                <td>{{ $m->slno }}</td>
                <td>{{ $m->moduleNo }}</td>
                <td>
                    <a href="{{ route('module.edit', $m) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('module.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this module?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center">No modules found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $modules->links() }}
</div>
@endsection