

<?php $__env->startSection('title', 'Daily Record Video List'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <h4 class="mb-3">Daily Record Video Records</h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-bordered table-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Program</th>
                <th>Module</th>
                <th>Paper</th>
                <th>Faculty</th>
                <th>Editor</th>
                <th width="130">Action</th>
            </tr>
        </thead>

        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($row->id); ?></td>

                <td><?php echo e($programs[$row->program_id] ?? '-'); ?></td>

                <td><?php echo e($modules[$row->module_id] ?? '-'); ?></td>

                <td><?php echo e($papers[$row->paper_id] ?? '-'); ?></td>

                <td><?php echo e($staffs[$row->faculty_id] ?? '-'); ?></td>

                <td><?php echo e($staffs[$row->editor_emp_id] ?? '-'); ?></td>

                <td>
                    <!-- Edit -->
                    <a href="<?php echo e(route('daily_record_video.edit', $row->id)); ?>"
                       class="btn btn-sm btn-primary">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="<?php echo e(route('daily_record_video.delete', $row->id)); ?>"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this record?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">
                    No records found
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/daily_record_video/index.blade.php ENDPATH**/ ?>