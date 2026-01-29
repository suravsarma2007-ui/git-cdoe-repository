<?php $__env->startSection('title', 'Program List - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Program Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo e(route('program.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Program
        </a>
    </div>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('program.index')); ?>" method="GET" class="row g-3">
            <div class="col-md-9">
                <input type="text" class="form-control" name="search" placeholder="Search by Program Name, ID, or Code..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>
                <?php if(request('search')): ?>
                    <a href="<?php echo e(route('program.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Programs (<?php echo e($programs->total()); ?>)</h5>
    </div>
    <div class="card-body">
        <?php if($programs->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Program Name</th>
                            <th>Program ID</th>
                            <th>Session Year</th>
                            <th>Program Code</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($programs->firstItem() + $index); ?></td>
                                <td><strong><?php echo e($program->program_name); ?></strong></td>
                                <td><span class="badge bg-info"><?php echo e($program->program_id); ?></span></td>
                                <td><?php echo e($program->session_year); ?></td>
                                <td><span class="badge bg-secondary"><?php echo e($program->program_code); ?></span></td>
                                <td><small><?php echo e($program->created_at->format('d-M-Y')); ?></small></td>
                                <td>
                                    <a href="<?php echo e(route('program.edit', $program)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo e(route('program.delete', $program)); ?>" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No programs found. <a href="<?php echo e(route('program.create')); ?>">Add one now</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($programs->hasPages()): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($programs->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-info text-center py-5">
                <h5>No Programs Yet</h5>
                <p class="mb-3">Get started by creating your first program.</p>
                <a href="<?php echo e(route('program.create')); ?>" class="btn btn-primary">Add Program</a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/program/index.blade.php ENDPATH**/ ?>