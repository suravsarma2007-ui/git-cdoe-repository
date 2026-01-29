

<?php $__env->startSection('title', 'Edit Daily Record Video'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <h4 class="mb-3">Edit Daily Record Video</h4>

    <form method="POST"
          action="<?php echo e(route('daily_record_video.update', $record->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Program ID</label>
                <input type="text" name="program_id"
                       value="<?php echo e(old('program_id', $record->program_id)); ?>"
                       class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Module ID</label>
                <input type="text" name="module_id"
                       value="<?php echo e(old('module_id', $record->module_id)); ?>"
                       class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Paper ID</label>
                <input type="text" name="paper_id"
                       value="<?php echo e(old('paper_id', $record->paper_id)); ?>"
                       class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Faculty ID</label>
                <input type="text" name="faculty_id"
                       value="<?php echo e(old('faculty_id', $record->faculty_id)); ?>"
                       class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Video No</label>
                <input type="number" name="video_no"
                       value="<?php echo e(old('video_no', $record->video_no)); ?>"
                       class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Recording Status</label>
                <input type="text" name="recording_status"
                       value="<?php echo e(old('recording_status', $record->recording_status)); ?>"
                       class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Recording Date</label>
                <input type="date" name="recording_date"
                       value="<?php echo e(old('recording_date', $record->recording_date)); ?>"
                       class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Editing Status</label>
                <input type="text" name="editing_status"
                       value="<?php echo e(old('editing_status', $record->editing_status)); ?>"
                       class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Editor Employee ID</label>
                <input type="text" name="editor_emp_id"
                       value="<?php echo e(old('editor_emp_id', $record->editor_emp_id)); ?>"
                       class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>PPT Status</label>
                <select name="ppt_status" class="form-control">
                    <option value="Yes" <?php echo e($record->ppt_status=='Yes'?'selected':''); ?>>Yes</option>
                    <option value="No" <?php echo e($record->ppt_status=='No'?'selected':''); ?>>No</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>PPT Submission Date</label>
                <input type="date" name="ppt_submission_date"
                       value="<?php echo e(old('ppt_submission_date', $record->ppt_submission_date)); ?>"
                       class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>ESLM Status</label>
                <select name="eslm_status" class="form-control">
                    <option value="Yes" <?php echo e($record->eslm_status=='Yes'?'selected':''); ?>>Yes</option>
                    <option value="No" <?php echo e($record->eslm_status=='No'?'selected':''); ?>>No</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>ESLM Submission Date</label>
                <input type="date" name="eslm_submission_date"
                       value="<?php echo e(old('eslm_submission_date', $record->eslm_submission_date)); ?>"
                       class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>ESLM Web Upload Status</label>
                <select name="eslm_web_upload_status" class="form-control">
                    <option value="Yes" <?php echo e($record->eslm_web_upload_status=='Yes'?'selected':''); ?>>Yes</option>
                    <option value="No" <?php echo e($record->eslm_web_upload_status=='No'?'selected':''); ?>>No</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>ESLM Web Upload Date</label>
                <input type="date" name="eslm_web_upload_date"
                       value="<?php echo e(old('eslm_web_upload_date', $record->eslm_web_upload_date)); ?>"
                       class="form-control">
            </div>

        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?php echo e(route('daily_record_video.index')); ?>" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/daily_record_video/edit.blade.php ENDPATH**/ ?>