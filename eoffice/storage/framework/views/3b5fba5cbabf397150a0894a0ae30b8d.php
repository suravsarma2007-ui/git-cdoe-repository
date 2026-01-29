<?php $__env->startSection('title', 'Papers List - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Papers Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo e(route('paper.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Paper
        </a>
        <a href="<?php echo e(route('paper.report')); ?>" class="btn btn-info ms-2">
            <i class="bi bi-file-earmark-text"></i> View Report
        </a>
    </div>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('paper.index')); ?>" method="GET" class="row g-3">
            <div class="col-md-9">
                <input type="text" class="form-control" name="search" placeholder="Search by Paper Name, Code, or Program..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>
                <?php if(request('search')): ?>
                    <a href="<?php echo e(route('paper.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Papers (<?php echo e($papers->total()); ?>)</h5>
    </div>
    <div class="card-body">
        <?php if($papers->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Program Name</th>
                            <th>Program ID</th>
                            <th>Paper Code</th>
                            <th>Paper Name</th>
                            <th>Module</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($papers->firstItem() + $index); ?></td>
                                <td>
                                    <span class="badge bg-success"><?php echo e($paper->program->program_name ?? '-'); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?php echo e($paper->program->program_id ?? '-'); ?></span>
                                </td>
                                <td><strong><?php echo e($paper->codes); ?></strong></td>
                                <td><?php echo e($paper->paper_name); ?></td>
                                <td><small><?php echo e($paper->module ?? '-'); ?></small></td>
                                <td><span class="badge bg-warning"><?php echo e($paper->semester); ?></span></td>
                                <td><span class="badge bg-secondary"><?php echo e($paper->years); ?></span></td>
                                <td>
                                    <a href="<?php echo e(route('paper.edit', $paper)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?php echo e(route('paper.delete', $paper)); ?>" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No papers found. <a href="<?php echo e(route('paper.create')); ?>">Add one now</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Customized Simple Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-2 mb-md-0 text-muted small">
                    Showing <?php echo e($papers->firstItem() ?? 0); ?> to <?php echo e($papers->lastItem() ?? 0); ?> of <?php echo e($papers->total()); ?> records
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            
                            <?php if($papers->onFirstPage()): ?>
                                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                            <?php else: ?>
                                <li class="page-item"><a class="page-link" href="<?php echo e($papers->previousPageUrl()); ?>" rel="prev">&laquo; Previous</a></li>
                            <?php endif; ?>

                            
                            <?php if($papers->hasMorePages()): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo e($papers->nextPageUrl()); ?>" rel="next">Next &raquo;</a></li>
                            <?php else: ?>
                                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center py-5">
                <h5>No Papers Yet</h5>
                <p class="mb-3">Get started by creating your first paper.</p>
                <a href="<?php echo e(route('paper.create')); ?>" class="btn btn-primary">Add Paper</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/paper/index.blade.php ENDPATH**/ ?>