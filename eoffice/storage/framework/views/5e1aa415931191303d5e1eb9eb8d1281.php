
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Video Recording Schedule</h4>
        <div>
            <a class="btn btn-primary" href="<?php echo e(route('video_schedule.create')); ?>">Create</a>
            <a class="btn btn-success" href="<?php echo e(route('video_schedule.exportCsv', request()->all())); ?>">Download CSV</a>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('video_schedule.index')); ?>" class="row g-2 mb-3">
        <div class="col-md-2">
            <select name="module_id" class="form-select" placeholder="Module">
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
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                <?php $__currentLoopData = $faculties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($f->id); ?>" <?php if(request('emp_id') == $f->id): echo 'selected'; endif; ?>><?php echo e($f->name); ?> (<?php echo e($f->emp_id); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="record_date" class="form-control" value="<?php echo e(request('record_date')); ?>" />
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Filter</button>
        </div>
    </form>

    <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Faculty Name</th>
                <th>Program</th>
                <th>Paper Name</th>
                <th>Module No</th>
                <th>Week No</th>
                <th>Record Date</th>
                <th>From Time</th>
                <th>To Time</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row->staff?->name); ?></td>
                <td><?php echo e($row->program?->program_name); ?></td>
                <td><?php echo e($row->paper?->paper_name); ?></td>
                <td><?php echo e($row->module?->moduleNo ?? $row->module?->moduleno ?? $row->module?->module_no); ?></td>
                <td><?php echo e($row->week?->week_no); ?></td>
                <td><?php echo e($row->record_date); ?></td>
                <td><?php echo e($row->from_time); ?></td>
                <td><?php echo e($row->to_time); ?></td>
                <td><?php echo e($row->status); ?></td>
                <td><?php echo e($row->remark); ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="<?php echo e(route('video_schedule.edit', $row)); ?>">Edit</a>
                    <form method="POST" action="<?php echo e(route('video_schedule.destroy', $row)); ?>" class="d-inline" onsubmit="return confirm('Delete this schedule?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($schedules->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/video_schedule/index.blade.php ENDPATH**/ ?>