

<?php $__env->startSection('title', 'Add Paper - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Modules</h4>
        <a class="btn btn-primary" href="<?php echo e(route('module.create')); ?>">Create Module</a>
    </div>

    <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Module No</th>
                <th style="width:160px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($m->slno); ?></td>
                <td><?php echo e($m->moduleNo); ?></td>
                <td>
                    <a href="<?php echo e(route('module.edit', $m)); ?>" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="<?php echo e(route('module.destroy', $m)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this module?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="3" class="text-center">No modules found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($modules->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/module/index.blade.php ENDPATH**/ ?>