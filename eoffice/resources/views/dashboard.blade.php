@extends('layouts.app')

@section('title', 'Dashboard - eOffice')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="card-body">
                <h4>Welcome, {{ auth()->user()->name ?? auth()->user()->email }}!</h4>
                <p class="text-muted">You are successfully logged in to eOffice.</p>

                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Staff Management</h5>
                                <p class="card-text">Manage all staff records and details</p>
                                <a href="{{ route('staff.index') }}" class="btn btn-sm btn-outline-primary">Go to Staff</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Program Management</h5>
                                <p class="card-text">Manage programs and sessions</p>
                                <a href="{{ route('program.index') }}" class="btn btn-sm btn-outline-primary">Go to Programs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Papers Management</h5>
                                <p class="card-text">Manage papers and coursework</p>
                                <a href="{{ route('paper.index') }}" class="btn btn-sm btn-outline-primary">Go to Papers</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Paper Allocations</h5>
                                <p class="card-text">Allocate papers to faculty and schedule sessions</p>
                                <a href="{{ route('paper_allocation.index') }}" class="btn btn-sm btn-outline-primary">Go to Allocations</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Videos Management</h5>
                                <p class="card-text">Track video production and uploads</p>
                                <a href="{{ route('video.index') }}" class="btn btn-sm btn-outline-primary">Go to Videos</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5>Quick Info</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
                        <li class="list-group-item"><strong>User ID:</strong> {{ auth()->user()->id }}</li>
                        <li class="list-group-item"><strong>Logged in since:</strong> {{ auth()->user()->created_at->format('M d, Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
