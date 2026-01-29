<?php $__env->startSection('title', 'Papers Report - eOffice'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Papers Report</h2>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Filter Report</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('paper.report')); ?>" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="program_id" class="form-label">Program</label>
                            <select class="form-select" id="program_id" name="program_id">
                                <option value="">-- All Programs --</option>
                                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($program->id); ?>" <?php echo e(request('program_id') == $program->id ? 'selected' : ''); ?>>
                                        <?php echo e($program->program_name); ?> (<?php echo e($program->program_id); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester">
                                <option value="">-- All Semesters --</option>
                                <?php for($i = 1; $i <= 8; $i++): ?>
                                    <option value="<?php echo e($i); ?>" <?php echo e(request('semester') == $i ? 'selected' : ''); ?>>Semester <?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="years" class="form-label">Year</label>
                            <select class="form-select" id="years" name="years">
                                <option value="">-- All Years --</option>
                                <?php for($i = 2025; $i <= 2035; $i++): ?>
                                    <option value="<?php echo e($i); ?>" <?php echo e(request('years') == $i ? 'selected' : ''); ?>>Year <?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   placeholder="Paper name or code..." value="<?php echo e(request('search')); ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter Report
                        </button>
                        <a href="<?php echo e(route('paper.report')); ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <?php if($papers->count() > 0): ?>
            <div class="card">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Papers List (<?php echo e($papers->count()); ?> records)</h5>
                    <div class="btn-group" role="group">
                        <a href="<?php echo e(route('paper.export-csv', request()->query())); ?>" class="btn btn-sm btn-light" title="Download CSV">
                            <i class="bi bi-file-csv"></i> CSV
                        </a>
                        <a href="<?php echo e(route('paper.export-excel', request()->query())); ?>" class="btn btn-sm btn-light" title="Download Excel">
                            <i class="bi bi-file-earmark-excel"></i> Excel
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 3%">#</th>
                                <th style="width: 12%">Program Name</th>
                                <th style="width: 10%">Program ID</th>
                                <th style="width: 15%">Paper Code</th>
                                <th style="width: 20%">Paper Name</th>
                                <th style="width: 12%">Module</th>
                                <th style="width: 8%">Semester</th>
                                <th style="width: 8%">Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($paper->program->program_name); ?></td>
                                    <td><?php echo e($paper->program->program_id); ?></td>
                                    <td><?php echo e($paper->codes); ?></td>
                                    <td><?php echo e($paper->paper_name); ?></td>
                                    <td><?php echo e($paper->module ?? '-'); ?></td>
                                    <td>Sem <?php echo e($paper->semester); ?></td>
                                    <td>Year <?php echo e($paper->years); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">
                                        No records found matching your filter criteria
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="mb-2 mb-md-0 text-muted small">
                        Showing <?php echo e($papers->firstItem() ?? 0); ?> to <?php echo e($papers->lastItem() ?? 0); ?> of <?php echo e($papers->total()); ?> records
                    </div>
                    <div>
                        <nav>
                            <ul class="pagination mb-0">
                                
                                <?php if($papers->onFirstPage()): ?>
                                    <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                                <?php else: ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo e($papers->previousPageUrl()); ?>" rel="prev">&laquo; Previous</a></li>
                                <?php endif; ?>

                                
                                <?php if($papers->hasMorePages()): ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo e($papers->nextPageUrl()); ?>" rel="next">Next &raquo;</a></li>
                                <?php else: ?>
                                    <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                No papers found. 
                <a href="<?php echo e(route('paper.create')); ?>">Create a new paper</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\cdoeOfficeAutomation\eoffice\resources\views/paper/report.blade.php ENDPATH**/ ?>