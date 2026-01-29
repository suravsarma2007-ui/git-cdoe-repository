<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Videos Management</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?php echo e(route('video.create')); ?>" class="btn btn-primary">+ Add New Video</a>
            <a href="<?php echo e(route('video.report')); ?>" class="btn btn-info">Report & Export</a>
        </div>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e($message); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('video.index')); ?>" class="row g-2">
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
                    <select name="paper_id" class="form-select form-select-sm">
                        <option value="">All Papers</option>
                        <?php $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($paper->id); ?>" <?php if(request('paper_id') == $paper->id): echo 'selected'; endif; ?>>
                                <?php echo e($paper->paper_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="emp_id" class="form-select form-select-sm">
                        <option value="">All Staff</option>
                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($member->id); ?>" <?php if(request('emp_id') == $member->id): echo 'selected'; endif; ?>>
                                <?php echo e($member->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="final_status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="Pending" <?php if(request('final_status') == 'Pending'): echo 'selected'; endif; ?>>Pending</option>
                        <option value="In Progress" <?php if(request('final_status') == 'In Progress'): echo 'selected'; endif; ?>>In Progress</option>
                        <option value="Completed" <?php if(request('final_status') == 'Completed'): echo 'selected'; endif; ?>>Completed</option>
                        <option value="On Hold" <?php if(request('final_status') == 'On Hold'): echo 'selected'; endif; ?>>On Hold</option>
                    </select>
                </div>
                <div class="col-md-1-5">
                    <input type="text" name="module_no" class="form-control form-control-sm" placeholder="Module No" value="<?php echo e(request('module_no')); ?>">
                </div>
                <div class="col-md-1-5">
                    <input type="date" name="date_from" class="form-control form-control-sm" placeholder="From Date" value="<?php echo e(request('date_from')); ?>">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-sm btn-secondary w-100">Filter</button>
                </div>
                <div class="col-md-1">
                    <a href="<?php echo e(route('video.index')); ?>" class="btn btn-sm btn-outline-secondary w-100">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Videos Table -->
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
                    <th>Final Status</th>
                    <th>Actions</th>
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
                        <td>
                            <span class="badge bg-<?php echo e($video->final_status === 'Completed' ? 'success' : ($video->final_status === 'In Progress' ? 'info' : ($video->final_status === 'On Hold' ? 'warning' : 'secondary'))); ?>">
                                <?php echo e($video->final_status ?? '-'); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('video.edit', $video->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?php echo e(route('video.delete', $video->id)); ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="13" class="text-center text-muted py-4">No videos found.</td>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/video/index.blade.php ENDPATH**/ ?>