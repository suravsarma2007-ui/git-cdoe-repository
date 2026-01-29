

<?php $__env->startSection('content'); ?>
<!-- All filter options are passed from the controller. No PHP logic here. -->
<div class="container-fluid">
  <?php if(session('success')): ?>
    <script>
      window.onload = function() {
        alert(<?php echo json_encode(session('success'), 15, 512) ?>);
      }
    </script>
  <?php endif; ?>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Target Final Report</h4>
    <a class="btn btn-outline-primary" href="<?php echo e(route('target.finalReportCsv', request()->except('page'))); ?>">Export CSV</a>
  </div>
  <form method="GET" action="" class="card shadow-sm mb-3">
    <div class="card-body">
      <div class="row g-3">
                <div class="col-12 col-md-2">
                  <label class="form-label">Module No</label>
                  <select name="module_id" class="form-select">
                    <option value="">All</option>
                    <?php $__currentLoopData = $moduleOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($module); ?>" <?php echo e(request('module_id') == $module ? 'selected' : ''); ?>><?php echo e($module); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Program Name</label>
          <select name="program" class="form-select">
            <option value="">All</option>
            <?php $__currentLoopData = $programOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($prog); ?>" <?php echo e(request('program') == $prog ? 'selected' : ''); ?>><?php echo e($prog); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Paper</label>
          <select name="PaperName" class="form-select">
            <option value="">All</option>
            <?php $__currentLoopData = $paperOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($paper); ?>" <?php echo e(request('PaperName') == $paper ? 'selected' : ''); ?>><?php echo e($paper); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Faculty Name</label>
          <select name="name" class="form-select">
            <option value="">All</option>
            <?php $__currentLoopData = $facultyOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($faculty); ?>" <?php echo e(request('name') == $faculty ? 'selected' : ''); ?>><?php echo e($faculty); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="">All</option>
            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($st); ?>" <?php echo e(request('status') == $st ? 'selected' : ''); ?>><?php echo e($st); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">From Date</label>
          <input type="date" name="from_date" value="<?php echo e(request('from_date')); ?>" class="form-control">
        </div>
        <div class="col-12 col-md-2">
          <label class="form-label">To Date</label>
          <input type="date" name="to_date" value="<?php echo e(request('to_date')); ?>" class="form-control">
        </div>
      </div>
      <div class="mt-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Apply Filters</button>
        <a href="<?php echo e(route('target.finalReport')); ?>" class="btn btn-secondary">Reset</a>
      </div>
    </div>
  </form>
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0 align-middle">
          <thead class="table-light">
            <tr>
              <th>Sl No</th>
              <th>Emp ID</th>
              <th>Name</th>
              <th>Program ID</th>
              <th>Program</th>
              <th>Paper ID</th>
              <th>Paper Name</th>
              <th>Module ID</th>
              <th>Week ID</th>
              <th>From Date</th>
              <th>To Date</th>
              <th>Status</th>              
              <th>Remark</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>ESLM</th>
              <th>ESLM Submitted Date</th>
              <th>PPT</th>
              <th>PPT Submitted Date</th>
              <th>Video Required</th>
              <th>Vedio Submitted</th>
              <th>Vidoe Submitted Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($row->slno ?? ''); ?></td>
                <td><?php echo e($row->emp_id ?? ''); ?></td>
                <td><?php echo e($row->name ?? ''); ?></td>
                <td><?php echo e($row->program_id ?? ''); ?></td>
                <td><?php echo e($row->program ?? ''); ?></td>
                <td><?php echo e($row->paper_id ?? ''); ?></td>
                <td><?php echo e($row->PaperName ?? ''); ?></td>
                <td><?php echo e($row->module_id ?? ''); ?></td>
                <td><?php echo e($row->week_id ?? ''); ?></td>
                <td><?php echo e(!empty($row->from_date) ? \Carbon\Carbon::parse($row->from_date)->format('Y-m-d') : ''); ?></td>
                <td><?php echo e(!empty($row->to_date) ? \Carbon\Carbon::parse($row->to_date)->format('Y-m-d') : ''); ?></td>
                 <td><?php echo e($row->status ?? ''); ?></td>               
                <td><?php echo e($row->remark ?? ''); ?></td>
                <td><?php echo e(!empty($row->created_at) ? \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i') : ''); ?></td>
                <td><?php echo e(!empty($row->updated_at) ? \Carbon\Carbon::parse($row->updated_at)->format('Y-m-d H:i') : ''); ?></td>
                <td><?php echo e($row->ESLM ?? ''); ?></td>
                <td><?php echo e(!empty($row->ElsmSubmittedDate) ? \Carbon\Carbon::parse($row->ElsmSubmittedDate)->format('Y-m-d') : ''); ?></td>
                <td><?php echo e($row->PPT ?? ''); ?></td>
                <td><?php echo e(!empty($row->PPTSubmittedDate) ? \Carbon\Carbon::parse($row->PPTSubmittedDate)->format('Y-m-d') : ''); ?></td>
                <td><?php echo e($row->VideoRequired ?? ''); ?></td>
                <td><?php echo e($row->VedioSubmitted ?? ''); ?></td>
                <td><?php echo e(!empty($row->VidoeSubmittedDate) ? \Carbon\Carbon::parse($row->VidoeSubmittedDate)->format('Y-m-d') : ''); ?></td>
                 <td>
                  <form method="POST" action="<?php echo e(route('target.finalReport.update', $row->slno)); ?>" class="d-flex align-items-center gap-1">
                    <?php echo csrf_field(); ?>
                    <select name="status" class="form-select form-select-sm" style="min-width: 120px; max-width: 200px;">
                      <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($st); ?>" <?php echo e($row->status == $st ? 'selected' : ''); ?>><?php echo e($st); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="22" class="text-center py-4">No records found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </tbody>
      </table>
    </div>
    <div class="p-3">
      <?php echo e($rows->withQueryString()->links('pagination::bootstrap-5')); ?>

    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
              </tr>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/target/final_report.blade.php ENDPATH**/ ?>