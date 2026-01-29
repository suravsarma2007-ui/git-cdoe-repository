<?php $__env->startSection('title', 'Staff List - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Staff Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo e(route('staff.create')); ?>" class="btn btn-primary me-2">
            <i class="bi bi-plus-circle"></i> Add New Staff
        </a>
        <a href="<?php echo e(route('staff.report')); ?>" class="btn btn-info">
            <i class="bi bi-file-earmark-text"></i> View Report
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Filter Staff</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('staff.index')); ?>" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="search" class="form-label">Name or EMP ID</label>
                <input type="text" class="form-control" id="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Enter name or EMP ID">
            </div>
            <div class="col-md-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e(request('designation')); ?>" placeholder="Designation">
            </div>
            <div class="col-md-3">
                <label for="staff_type" class="form-label">Staff Type</label>
                <select class="form-select" id="staff_type" name="staff_type">
                    <option value="">-- All Types --</option>
                    <option value="Faculty" <?php echo e(request('staff_type') == 'Faculty' ? 'selected' : ''); ?>>Faculty</option>
                    <option value="Non-Teaching" <?php echo e(request('staff_type') == 'Non-Teaching' ? 'selected' : ''); ?>>Non-Teaching</option>
                    <option value="Support" <?php echo e(request('staff_type') == 'Support' ? 'selected' : ''); ?>>Support</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <?php if(request('search') || request('designation') || request('staff_type')): ?>
                    <a href="<?php echo e(route('staff.index')); ?>" class="btn btn-secondary w-100">Reset</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Staff Records</h5>
    </div>
    <div class="card-body">
        <?php if($staff->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>EMP ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Staff Type</th>
                            <th>Official Email</th>
                            <th>Contact</th>
                            <th>DOJ</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($staff->firstItem() + $index); ?></td>
                                <td><strong><?php echo e($member->emp_id); ?></strong></td>
                                <td><?php echo e($member->name); ?></td>
                                <td><?php echo e($member->designation); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($member->staff_type === 'Faculty' ? 'success' : ($member->staff_type === 'Non-Teaching' ? 'warning' : 'info')); ?>">
                                        <?php echo e($member->staff_type); ?>

                                    </span>
                                </td>
                                <td><?php echo e($member->official_email ?? '-'); ?></td>
                                <td><?php echo e($member->contact ?? '-'); ?></td>
                                <td><?php echo e($member->doj->format('d-M-Y')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('staff.edit', $member)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo e(route('staff.delete', $member)); ?>" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No staff records found. <a href="<?php echo e(route('staff.create')); ?>">Add one now</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Customized Simple Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <div class="mb-2 mb-md-0 text-muted small">
                    Showing <?php echo e($staff->firstItem() ?? 0); ?> to <?php echo e($staff->lastItem() ?? 0); ?> of <?php echo e($staff->total()); ?> records
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            
                            <?php if($staff->onFirstPage()): ?>
                                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                            <?php else: ?>
                                <li class="page-item"><a class="page-link" href="<?php echo e($staff->previousPageUrl()); ?>" rel="prev">&laquo; Previous</a></li>
                            <?php endif; ?>

                            
                            <?php if($staff->hasMorePages()): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo e($staff->nextPageUrl()); ?>" rel="next">Next &raquo;</a></li>
                            <?php else: ?>
                                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center py-5">
                <h5>No Staff Records Yet</h5>
                <p class="mb-3">Get started by adding your first staff member.</p>
                <a href="<?php echo e(route('staff.create')); ?>" class="btn btn-primary">Add Staff Member</a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/staff/index.blade.php ENDPATH**/ ?>