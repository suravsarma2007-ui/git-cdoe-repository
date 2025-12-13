@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Upload Module Files for ESLM Record</h2>
    <form method="POST" action="{{ route('eslm.module-upload', $eslm->id) }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Module No</th>
                    <th>Upload File</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1; $i<=20; $i++)
                    <tr>
                        <td>Module {{ $i }}</td>
                        <td>
                            <input type="file" name="module_files[{{ $i }}]" class="form-control" accept=".pdf,.doc,.docx,.zip">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Upload Files</button>
        <a href="{{ route('eslm.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
