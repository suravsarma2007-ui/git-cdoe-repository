<?php $__env->startSection('title', 'Staff Report - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<style>
    @media print {
        .no-print { display: none; }
        body { font-size: 12px; }
        table { page-break-inside: avoid; }
    }
</style>

<div class="no-print">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Staff Report</h2>
        </div>
        <div class="col-md-4 text-end">
            <button onclick="window.print()" class="btn btn-secondary me-2">
                <i class="bi bi-printer"></i> Print
            </button>
            <a href="<?php echo e(route('staff.index')); ?>" class="btn btn-info">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Filters</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('staff.report')); ?>" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search by Name or ID</label>
                    <input type="text" class="form-control" id="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Enter name or EMP ID">
                </div>

                <div class="col-md-3">
                    <label for="staff_type" class="form-label">Staff Type</label>
                    <select class="form-select" id="staff_type" name="staff_type">
                        <option value="">-- All Types --</option>
                        <?php $__currentLoopData = $staffTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php echo e(request('staff_type') === $type ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="discipline" class="form-label">Discipline</label>
                    <select class="form-select" id="discipline" name="discipline">
                        <option value="">-- All Disciplines --</option>
                        <?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($disc); ?>" <?php echo e(request('discipline') === $disc ? 'selected' : ''); ?>><?php echo e($disc); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="<?php echo e(route('staff.report')); ?>" class="btn btn-light border">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Staff Records (Total: <?php echo e(count($staff)); ?>)</h5>
    </div>
    <div class="card-body">
        <?php if($staff->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>EMP ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Staff Type</th>
                            <th>Discipline</th>
                            <th>Subject</th>
                            <th>Official Email</th>
                            <th>Personal Email</th>
                            <th>Contact</th>
                            <th>DOJ</th>
                            <th style="width: 15%;">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($staff->firstItem() + $index); ?></td>
                                <td><strong><?php echo e($member->emp_id); ?></strong></td>
                                <td><?php echo e($member->name); ?></td>
                                <td><?php echo e($member->designation); ?></td>
                                <td><?php echo e($member->staff_type); ?></td>
                                <td><?php echo e($member->discipline ?? '-'); ?></td>
                                <td><?php echo e($member->subject ?? '-'); ?></td>
                                <td><?php echo e($member->official_email ?? '-'); ?></td>
                                <td><?php echo e($member->personal_email ?? '-'); ?></td>
                                <td><?php echo e($member->contact ?? '-'); ?></td>
                                <td><?php echo e($member->doj->format('d-M-Y')); ?></td>
                                <td style="font-size: 0.9em;"><?php echo e($member->address ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="12" class="text-center text-muted py-4">
                                    No staff records match your filters.
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
           
            <!-- Report Summary -->
            <div class="row mt-4 pt-3 border-top no-print">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Staff</h5>
                            <h3><?php echo e($totalStaffCount); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Faculty</h5>
                            <h3><?php echo e($facultyCount); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Non-Teaching</h5>
                            <h3><?php echo e($nonTeachingCount); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Support Staff</h5>
                            <h3><?php echo e($supportCount); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center py-5">
                <h5>No Staff Records Found</h5>
                <p>Try adjusting your filters or <a href="<?php echo e(route('staff.index')); ?>">go back to the staff list</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="no-print mt-3 text-center">
    <p class="text-muted small">Generated on <?php echo e(now()->format('d-M-Y H:i:s')); ?></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/staff/report.blade.php ENDPATH**/ ?>