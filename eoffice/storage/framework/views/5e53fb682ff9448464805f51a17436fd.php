<?php $__env->startSection('title', 'Paper Allocations - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Paper Allocations</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo e(route('paper_allocation.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Allocation
        </a>
        <a href="<?php echo e(route('paper_allocation.export-csv', request()->query())); ?>" class="btn btn-outline-secondary ms-2">CSV</a>
        <a href="<?php echo e(route('paper_allocation.export-excel', request()->query())); ?>" class="btn btn-outline-secondary ms-2">Excel</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('paper_allocation.index')); ?>" method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by paper or faculty" value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="program_id" class="form-select">
                    <option value="">-- All Programs --</option>
                    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id); ?>" <?php echo e(request('program_id') == $p->id ? 'selected' : ''); ?>><?php echo e($p->program_name); ?> (<?php echo e($p->program_id); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="semester" class="form-select">
                    <option value="">-- Semester --</option>
                    <?php for($i=1;$i<=8;$i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e(request('semester') == $i ? 'selected' : ''); ?>>Sem <?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="year" class="form-select">
                    <option value="">-- Year --</option>
                    <?php $current = date('Y'); ?>
                    <?php for($y = $current - 5; $y <= $current + 1; $y++): ?>
                        <option value="<?php echo e($y); ?>" <?php echo e(request('year') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('paper_allocation.index')); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <?php if($allocations->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program</th>
                            <th>Paper</th>
                            <th>Faculty</th>
                            <th>Module No</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th>Week No</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $allocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($allocations->firstItem() + $idx); ?></td>
                                <td><?php echo e($a->paper->program->program_name ?? '-'); ?></td>
                                <td><?php echo e($a->paper->paper_name ?? '-'); ?></td>
                                <td><?php echo e($a->staff->name ?? '-'); ?></td>
                                <td><?php echo e($a->module_no ?? '-'); ?></td>
                                <td><?php echo e($a->semester); ?></td>
                                <td><?php echo e($a->year); ?></td>
                                <td><?php echo e($a->week_no); ?></td>
                                <td><?php echo e($a->date?->toDateString() ?? '-'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('paper_allocation.edit', $a)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?php echo e(route('paper_allocation.delete', $a)); ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($allocations->appends(request()->query())->links('pagination::bootstrap-5')); ?>

            </div>
        <?php else: ?>
            <div class="alert alert-info">No allocations yet.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/paper_allocation/index.blade.php ENDPATH**/ ?>