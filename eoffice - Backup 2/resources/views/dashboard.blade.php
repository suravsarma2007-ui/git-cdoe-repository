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
                    
                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-primary text-white rounded-top">👥</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">👥 Staff Management</h5>
                                <p class="card-text">Manage all staff records and details</p>
                                <a href="{{ route('staff.index') }}" class="btn btn-sm btn-outline-primary">Go to Staff</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-success text-white rounded-top">📚</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">📚 Program Management</h5>
                                <p class="card-text">Manage programs and sessions</p>
                                <a href="{{ route('program.index') }}" class="btn btn-sm btn-outline-primary">Go to Programs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-warning text-dark rounded-top">📝</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">📝 Papers Management</h5>
                                <p class="card-text">Manage papers and coursework</p>
                                <a href="{{ route('paper.index') }}" class="btn btn-sm btn-outline-primary">Go to Papers</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-info text-white rounded-top">📌</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">📌 Paper Allocations</h5>
                                <p class="card-text">Allocate papers to faculty</p>
                                <a href="{{ route('paper_allocation.index') }}" class="btn btn-sm btn-outline-primary">Go to Allocations</a>
                            </div>
                        </div>
                    </div>                    
                </div>

                <hr>

                <div class="row mt-4">
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <div class="card text-center border-0 shadow rounded">
                                <div class="p-2 bg-secondary text-white rounded-top">🎧</div>
                                <div class="card-body bg-light rounded-bottom">
                                    <h5 class="card-title">🎧 ESLM Management</h5>
                                    <p class="card-text">Upload, track, and report ESLM</p>
                                    <a href="{{ route('eslm.index') }}" class="btn btn-sm btn-outline-primary">Go to ESLM</a>
                                </div>
                            </div>
                        </div>
                        
                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-danger text-white rounded-top">🎬</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">🎬 Videos Management</h5>
                                <p class="card-text">Track video production and uploads</p>
                                <a href="{{ route('video.index') }}" class="btn btn-sm btn-outline-primary">Go to Videos</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-primary text-white rounded-top">📊</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">📊 PPT Management</h5>
                                <p class="card-text">Upload, track, and report PPT</p>
                                <a href="{{ route('ppt.index') }}" class="btn btn-sm btn-outline-primary">Go to PPT</a>
                            </div>
                        </div>
                    </div>

                     <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-success text-white rounded-top">🎓</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">🎓 Academic Session</h5>
                                <p class="card-text">Create, manage and delete Sessions</p>
                                <a href="{{ route('academic_session.index') }}" class="btn btn-sm btn-outline-primary">Go to Academic Sessions</a>
                            </div>
                        </div>
                    </div>
                   
                 </div>

                <hr>

                <div class="row mt-4">
                    

                     <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-dark text-white rounded-top">📦</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">📦 Modules</h5>
                                <p class="card-text">Create, manage and delete Modules</p>
                                <a href="{{ route('module.index') }}" class="btn btn-sm btn-outline-primary">Go to Modules</a>
                            </div>
                        </div>
                    </div>

                     <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-warning text-dark rounded-top">📹</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">📹 Video Record Schedule</h5>
                                <p class="card-text">Create, edit and report schedules</p>
                                <a href="{{ route('video_schedule.index') }}" class="btn btn-sm btn-outline-primary">Open Schedule</a>
                            </div>
                        </div>
                    </div>   

                     <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <div class="card text-center border-0 shadow rounded">
                            <div class="p-2 bg-success text-white rounded-top">🎯</div>
                            <div class="card-body bg-light rounded-bottom">
                                <h5 class="card-title">🎯 Targets</h5>
                                <p class="card-text">Plan and track targets</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('target.index') }}" class="btn btn-sm btn-outline-primary">Open Targets</a>
                                    <a href="{{ route('target.finalReport') }}" class="btn btn-sm btn-outline-secondary">Final Report</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

               
            </div>
        </div>
    </div>
</div>
@endsection
