
<?php $__env->startSection('title', 'ESLM Report'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>ESLM Report</h2>
        <a href="<?php echo e(route('eslm.create')); ?>" class="btn btn-success">+ New ESLM Record</a>
    </div>
    <form method="GET" action="<?php echo e(route('eslm.index')); ?>" class="row g-3 mb-3">
        <div class="col-md-2">
            <select name="program_id" class="form-select">
                <option value="">All Programs</option>
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($prog->id); ?>" <?php echo e(request('program_id') == $prog->program_id ? 'selected' : ''); ?>><?php echo e($prog->program_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="codes" class="form-select">
                <option value="">All Papers</option>
                <?php $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($p->id); ?>" <?php echo e(request('codes') == $p->id ? 'selected' : ''); ?>><?php echo e($p->paper_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="module_no" class="form-select">
                <option value="">All Modules</option>
                <?php for($i=1;$i<=12;$i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e(request('module_no') == $i ? 'selected' : ''); ?>>Module <?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="emp_id" class="form-select">
                <option value="">All Faculty</option>
                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->emp_id); ?>" <?php echo e(request('emp_id') == $s->emp_id ? 'selected' : ''); ?>><?php echo e($s->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="Pending" <?php echo e(request('status') == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="Done" <?php echo e(request('status') == 'Done' ? 'selected' : ''); ?>>Done</option>
                <option value="Done & Uploaded" <?php echo e(request('status') == 'Done & Uploaded' ? 'selected' : ''); ?>>Done & Uploaded</option>
            </select>
        </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100 mb-2">Filter</button>
        <a href="<?php echo e(route('eslm.export-csv', request()->all())); ?>" class="btn btn-info w-100">Download CSV</a>
    </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Program Name</th>
                    <th>Paper Name</th>
                    <th>Faculty Name</th>
                    <th>Module No</th>
                    <th>Status</th>
                    <th>Date of Submit</th>
                    <th>File Link</th>
                    <th>Remark</th>
                    <th>Block</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $eslms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>               
                <tr>
                    <td><?php echo e($row->id); ?></td>
                    <td><?php echo e($row->program?->program_name); ?></td>
                    <td><?php echo e($row->paper?->paper_name); ?></td>
                    <td><?php echo e($row->staff?->name); ?></td>
                    <td><?php echo e($row->module_no); ?></td>
                    <td><?php echo e($row->status); ?></td>
                    <td><?php echo e($row->date_of_submit); ?></td>
                    <td>
                        <?php if($row->file_upload_link): ?>
                            <a href="<?php echo e(asset('storage/' . $row->file_upload_link)); ?>" target="_blank">View</a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($row->remark); ?></td>
                    <td><?php echo e($row->block); ?></td>
                    <td>
                        <a href="<?php echo e(route('eslm.edit', $row->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo e(route('eslm.delete', $row->id)); ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div>
        <?php echo e($eslms->withQueryString()->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/eslm/index.blade.php ENDPATH**/ ?>