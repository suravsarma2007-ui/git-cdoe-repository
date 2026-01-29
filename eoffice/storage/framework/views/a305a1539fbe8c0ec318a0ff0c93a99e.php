<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>PPT Report</h2>
    <form method="GET" action="<?php echo e(route('ppt.index')); ?>" class="row g-3 mb-3">
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($program->id); ?>" <?php if(request('program_id') == $program->id): ?> selected <?php endif; ?>><?php echo e($program->program_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="paper_id" class="form-select">
                <option value="">All Papers</option>
                <?php $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($paper->id); ?>" <?php if(request('paper_id') == $paper->id): ?> selected <?php endif; ?>><?php echo e($paper->paper_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="module_no" class="form-control" placeholder="Module No" value="<?php echo e(request('module_no')); ?>">
        </div>
        <div class="col-md-2">
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>" <?php if(request('emp_id') == $s->id): ?> selected <?php endif; ?>><?php echo e($s->name); ?> (<?php echo e($s->emp_id); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="Pending" <?php if(request('status') == 'Pending'): ?> selected <?php endif; ?>>Pending</option>
                <option value="Done" <?php if(request('status') == 'Done'): ?> selected <?php endif; ?>>Done</option>
                <option value="Done and Upload" <?php if(request('status') == 'Done and Upload'): ?> selected <?php endif; ?>>Done and Upload</option>
            </select>
        </div>
            <div class="col-md-2">
                <select name="semester" class="form-select">
                    <option value="">All Semesters</option>
                    <?php $__currentLoopData = $papers->pluck('semester')->unique()->sort(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($sem): ?>
                            <option value="<?php echo e($sem); ?>" <?php if(request('semester') == $sem): ?> selected <?php endif; ?>>Semester <?php echo e($sem); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
    <div class="d-flex justify-content-between mb-3">
        <a href="<?php echo e(route('ppt.create')); ?>" class="btn btn-primary">Create PPT</a>
        <a href="<?php echo e(url('ppt/export-csv') . (count(request()->all()) ? '?' . http_build_query(request()->all()) : '')); ?>" class="btn btn-success">Download CSV</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Program Name</th>
                <th>Paper Name</th>
                <th>Semester</th>
                <th>Faculty Name</th>
                <th>Module No</th>
                <th>Status</th>
                <th>No of PPT</th>
                <th>Screen Recording</th>
                <th>Remarks</th>
                <th>Total</th>
                <th>Date Of Submit</th>
                <th>PPT File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $ppts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ppt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($ppt->id); ?></td>
                <td><?php echo e($ppt->program?->program_name); ?></td>
                <td>
                    <?php if(is_object($ppt->paper)): ?>
                        <?php echo e($ppt->paper->paper_name); ?>

                    <?php elseif(!empty($ppt->paper)): ?>
                        <?php echo e($ppt->paper); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo e(\App\Http\Controllers\PptReportHelper::getSemesterByPaperId($ppt->paper_id)); ?>

                </td>
                <td>
                    <?php
                        $faculty = $staff->firstWhere('id', $ppt->emp_id) ?? $staff->firstWhere('emp_id', $ppt->emp_id);
                    ?>
                    <?php echo e($faculty ? $faculty->name . ' (' . $faculty->emp_id . ')' : $ppt->emp_id); ?>

                </td>
                <td><?php echo e($ppt->module_no); ?></td>
                <td><?php echo e($ppt->status); ?></td>
                <td><?php echo e($ppt->no_of_ppt); ?></td>
                <td><?php echo e($ppt->screen_recording); ?></td>
                <td><?php echo e($ppt->remarks); ?></td>
                <td><?php echo e($ppt->total); ?></td>
                <td><?php echo e($ppt->date_of_submit); ?></td>
                <td>
                    <?php if($ppt->ppt_file_link): ?>
                        <a href="<?php echo e(asset('storage/' . $ppt->ppt_file_link)); ?>" target="_blank">View</a>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('ppt.edit', $ppt->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?php echo e(route('ppt.destroy', $ppt->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($ppts->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/ppt/index.blade.php ENDPATH**/ ?>