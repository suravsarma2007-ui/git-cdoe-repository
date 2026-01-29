
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Targets</h4>
        <div>
            <a class="btn btn-primary" href="<?php echo e(route('target.create')); ?>">Create</a>
            <a class="btn btn-success" href="<?php echo e(route('target.exportCsv', request()->all())); ?>">Download CSV</a>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('target.index')); ?>" class="row g-2 mb-3">
        <div class="col-md-2">
            <select name="module_id" class="form-select">
                <option value="">All Modules</option>
                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->slno); ?>" <?php if(request('module_id') == $m->slno): echo 'selected'; endif; ?>><?php echo e($m->moduleNo ?? $m->moduleno ?? $m->module_no); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="week_id" class="form-select">
                <option value="">All Weeks</option>
                <?php $__currentLoopData = $weeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($w->id); ?>" <?php if(request('week_id') == $w->id): echo 'selected'; endif; ?>>Week <?php echo e($w->week_no); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($p->id); ?>" <?php if(request('program_id') == $p->id): echo 'selected'; endif; ?>><?php echo e($p->program_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="paper_id" class="form-select">
                <option value="">All Papers</option>
                <?php $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($paper->id); ?>" <?php if(request('paper_id') == $paper->id): echo 'selected'; endif; ?>><?php echo e($paper->paper_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                <?php $__currentLoopData = $faculties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($f->id); ?>" <?php if(request('emp_id') == $f->id): echo 'selected'; endif; ?>><?php echo e($f->name); ?> (<?php echo e($f->emp_id); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="NA" <?php if(request('status')=='NA'): echo 'selected'; endif; ?>>NA</option>
                <option value="Pending" <?php if(request('status')=='Pending'): echo 'selected'; endif; ?>>Pending</option>
                <option value="Completed" <?php if(request('status')=='Completed'): echo 'selected'; endif; ?>>Completed</option>
            </select>
        </div>
        <div class="col-12 col-md-2 mt-2 mt-md-0">
            <button class="btn btn-primary w-100" type="submit">Filter</button>
        </div>
    </form>

    <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Faculty Name</th>
                <th>Program</th>
                <th>Paper Name</th>
                <th>Module No</th>
                <th>Week No</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($row->slno); ?></td>
                <td><?php echo e($row->staff?->name); ?></td>
                <td><?php echo e($row->program?->program_name); ?></td>
                <td><?php echo e($row->paper?->paper_name); ?></td>
                <td><?php echo e($row->module?->moduleNo ?? $row->module?->moduleno ?? $row->module?->module_no); ?></td>
                <td><?php echo e($row->week?->week_no); ?></td>
                <td><?php echo e($row->from_date); ?></td>
                <td><?php echo e($row->to_date); ?></td>
                <td><?php echo e($row->status); ?></td>
                <td><?php echo e($row->remark); ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="<?php echo e(route('target.edit', $row)); ?>">Edit</a>
                    <form method="POST" action="<?php echo e(route('target.destroy', $row)); ?>" class="d-inline" onsubmit="return confirm('Delete this target?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="11" class="text-center">No targets found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($targets->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/target/index.blade.php ENDPATH**/ ?>