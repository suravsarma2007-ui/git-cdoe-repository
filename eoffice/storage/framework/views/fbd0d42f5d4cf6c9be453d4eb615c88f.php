
<?php $__env->startSection('title', 'Add ESLM Record'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Add ESLM Record</h2>
    <form method="POST" action="<?php echo e(route('eslm.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="program_select" class="form-label">Program Name</label>
            <select id="program_select" name="program_id" class="form-select mb-2" required>
                <option value="">-- Select Program --</option>
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($prog->id); ?>"><?php echo e($prog->program_name); ?> (<?php echo e($prog->program_id); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="paper_id" class="form-label">Paper Name</label>
            <select name="paper_id" id="paper_id" class="form-select" required>
                <option value="">-- Select Paper --</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="emp_id" class="form-label">Faculty Name</label>
            <select name="emp_id" id="emp_id" class="form-select" required>
                <option value="">-- Select Faculty --</option>
                <?php $__currentLoopData = App\Models\Staff::where('staff_type', 'Faculty')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->emp_id); ?>"><?php echo e($s->name); ?> (<?php echo e($s->emp_id); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="module_no" class="form-label">Module No</label>
            <select name="module_no" id="module_no" class="form-select" required>
                <option value="">-- Select Module --</option>
                <?php for($i=1;$i<=12;$i++): ?>
                    <option value="<?php echo e($i); ?>">Module <?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
                <option value="Done & Uploaded">Done & Uploaded</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="remark" class="form-label">Remark</label>
            <textarea name="remark" id="remark" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="block" class="form-label">Block</label>
            <input type="text" name="block" id="block" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?php echo e(route('eslm.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    (function(){
        const prog = document.getElementById('program_select');
        const paper = document.getElementById('paper_id');
        async function loadPapers(programId){
            if(!programId) { paper.innerHTML = '<option value="">-- Select Paper --</option>'; return; }
            const res = await fetch(`/paper/by-program/${programId}`);
            if(!res.ok) return;
            const data = await res.json();
            paper.innerHTML = '<option value="">-- Select Paper --</option>';
            data.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p.id;
                opt.textContent = `${p.paper_name} (${p.id})`;
                paper.appendChild(opt);
            });
        }
        prog.addEventListener('change', function(){ loadPapers(this.value); });
        document.addEventListener('DOMContentLoaded', function(){ loadPapers(prog.value); });
    })();
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/eslm/create.blade.php ENDPATH**/ ?>