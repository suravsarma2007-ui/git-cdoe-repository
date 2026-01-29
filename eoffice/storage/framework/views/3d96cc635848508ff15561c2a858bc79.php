<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h2>Videos Report</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('video.index')); ?>" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card mb-3">
        <div class="card-header bg-light">
            <h5 class="mb-0">Filters & Export</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('video.report')); ?>" class="row g-2 mb-3">
                <div class="col-md-2">
                    <select name="program_id" class="form-select form-select-sm">
                        <option value="">All Programs</option>
                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($program->id); ?>" <?php if(request('program_id') == $program->id): echo 'selected'; endif; ?>>
                                <?php echo e($program->program_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="semester" class="form-select form-select-sm">
                        <option value="">All Semesters</option>
                        <?php for($i = 1; $i <= 8; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php if(request('semester') == $i): echo 'selected'; endif; ?>>Sem <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="month" class="form-select form-select-sm">
                        <option value="">All Months</option>
                        <?php for($m = 1; $m <= 12; $m++): ?>
                            <option value="<?php echo e($m); ?>" <?php if(request('month') == $m): echo 'selected'; endif; ?>>
                                <?php echo e(\Carbon\Carbon::createFromFormat('m', $m)->format('F')); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="year" class="form-select form-select-sm">
                        <option value="">All Years</option>
                        <?php for($y = date('Y') - 5; $y <= date('Y'); $y++): ?>
                            <option value="<?php echo e($y); ?>" <?php if(request('year') == $y): echo 'selected'; endif; ?>><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 text-end">
                    <button type="submit" class="btn btn-sm btn-primary">Apply Filters</button>
                    <a href="<?php echo e(route('video.report')); ?>" class="btn btn-sm btn-outline-secondary">Clear</a>
                </div>
            </form>

            <!-- Export Buttons -->
            <div class="row g-2 border-top pt-3">
                <div class="col-md-12">
                    <h6 class="mb-2">Export Report:</h6>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="<?php echo e(route('video.export-csv')); ?>" class="d-inline">
                        <?php $__currentLoopData = request()->query(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="format" value="all">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV (All)
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="<?php echo e(route('video.export-excel')); ?>" class="d-inline">
                        <?php $__currentLoopData = request()->query(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="format" value="all">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel (All)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Video Entries Report</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>SL No</th>
                            <th>Program</th>
                            <th>Paper</th>
                            <th>Staff</th>
                            <th>Module</th>
                            <th>Semester</th>
                            <th>Videos Required</th>
                            <th>Videos Done</th>
                            <th>Videos Edited</th>
                            <th>Uploaded</th>
                            <th>Upload Date</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Final Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(($videos->currentPage() - 1) * 15 + $index + 1); ?></td>
                                <td><?php echo e($video->program->program_name ?? '-'); ?></td>
                                <td><?php echo e($video->paper->paper_name ?? '-'); ?></td>
                                <td><?php echo e($video->staff->name ?? '-'); ?></td>
                                <td><?php echo e($video->module_no ?? '-'); ?></td>
                                <td><?php echo e($video->semester); ?></td>
                                <td><?php echo e($video->total_videos_required); ?></td>
                                <td><?php echo e($video->total_videos_done); ?></td>
                                <td><?php echo e($video->total_videos_edited); ?></td>
                                <td><?php echo e($video->uploaded_videos); ?></td>
                                <td><?php echo e($video->upload_date?->toDateString() ?? '-'); ?></td>
                                <td><?php echo e($video->month); ?></td>
                                <td><?php echo e($video->year); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($video->final_status === 'Completed' ? 'success' : ($video->final_status === 'In Progress' ? 'info' : ($video->final_status === 'On Hold' ? 'warning' : 'secondary'))); ?>">
                                        <?php echo e($video->final_status ?? '-'); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="14" class="text-center text-muted py-4">No video entries found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Customized Simple Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-2 mb-md-0 text-muted small">
                    Showing <?php echo e($videos->firstItem() ?? 0); ?> to <?php echo e($videos->lastItem() ?? 0); ?> of <?php echo e($videos->total()); ?> records
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            
                            <?php if($videos->onFirstPage()): ?>
                                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                            <?php else: ?>
                                <li class="page-item"><a class="page-link" href="<?php echo e($videos->previousPageUrl()); ?>" rel="prev">&laquo; Previous</a></li>
                            <?php endif; ?>

                            
                            <?php if($videos->hasMorePages()): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo e($videos->nextPageUrl()); ?>" rel="next">Next &raquo;</a></li>
                            <?php else: ?>
                                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/video/report.blade.php ENDPATH**/ ?>