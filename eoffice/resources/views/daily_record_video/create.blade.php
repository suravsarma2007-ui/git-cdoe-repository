@extends('layouts.app')

@section('title', 'Add Daily Video Record')

@section('content')

<form method="POST" action="{{ route('daily_record_video.store') }}">
    @csrf

    <div class="mb-3">
    <level> <h4>Program and Paper Details</h4></level>
    <hr style="border-top: 4px solid #000;">
        <label>Program</label>
        <select name="program_id" id="program_id" class="form-control" required>
            <option value="">-- Select Program --</option>
            @foreach($programs as $program)
                <option value="{{ $program->id }}">
                    {{ $program->program_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Module</label>
        <select name="module_id" class="form-control" required>
            @foreach($modules as $module)
                <option value="{{ $module->slno }}">
                    {{ $module->moduleNo }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Paper</label>
        <select name="paper_id" id="paper_id" class="form-control" required>
            <option value="">-- Select Paper --</option>
        </select>
    </div>


    <div class="mb-3">
        <label>Faculty Name</label>
        <select name="faculty_id" id="faculty_id" class="form-control" required>
             <option value="">-- Select faculty --</option>
        </select>
    </div>



    <level> <h4>Video Class Details </h4></level>
    <hr style="border-top: 4px solid #000;">

    <div class="mb-3">
        <label>Video No</label>
        <input type="text" name="video_no" class="form-control">
    </div>    

    <div class="mb-3">
        <label>Recording Status</label>      
         <select name="recording_status" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
     <div class="mb-3">
        <label>Recording Date</label>
        <input type="date" name="recodring_date" class="form-control">
    </div>


    <div class="mb-3">
        <label>Editing Status</label>       
        <select name="editing_status" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Editor Name</label>
        <select name="editor_emp_id" id="editor_emp_id" class="form-control" required>
            <option value="">-- Select Editor --</option>
            @foreach($editors as $editor)
                <option value="{{ $editor->id }}">
                    {{ $editor->name }}
                </option>
            @endforeach
        </select>

    </div>

   

    
    <level> <h4>PPT and ESLM Details </h4></level>
    <hr style="border-top: 4px solid #000;">

    <div class="mb-3">
        <label>PPT Submitted</label>
        <select name="ppt_status" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
     <div class="mb-3">
        <label>PPT Submission Date</label>
        <input type="date" name="ppt_submittion_date" class="form-control">
    </div>


    <div class="mb-3">
        <label>ESLM Submitted</label>
        <select name="eslm_status" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

     <div class="mb-3">
        <label>ESLM Submission Date</label>
        <input type="date" name="eslm_submittion_date" class="form-control">
    </div>


     <level> <h4>Website Upload Details </h4></level>
    <hr style="border-top: 4px solid #000;">

    <div class="mb-3">
        <label>ESLM Website Uploaded Status</label>
        <select name="eslm_web_upload_status" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    <div class="mb-3">
        <label>ESLM Wesite Upload Date</label>
        <input type="date" name="eslm_web_upload_date" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    /* ===============================
       Program → Paper
    =============================== */
    $('#program_id').on('change', function () {
        let programId = $(this).val();

        $('#paper_id').html('<option value="">Loading...</option>');
        $('#faculty_id').html('<option value="">-- Select Faculty --</option>');

        if (programId) {
            $.ajax({
                url: '/get-papers/' + programId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    let options = '<option value="">-- Select Paper --</option>';

                    if (data.length > 0) {
                        $.each(data, function (i, paper) {
                            options += '<option value="' + paper.id + '">' +
                                paper.paper_name +
                                '</option>';
                        });
                    } else {
                        options += '<option value="">No Paper Found</option>';
                    }

                    $('#paper_id').html(options);
                },
                error: function () {
                    $('#paper_id').html('<option value="">Error loading papers</option>');
                }
            });
        }
    });


    /* ===============================
       Paper → Faculty
    =============================== */
   $('#paper_id').change(function () {

    var paperId = $(this).val();
    $('#faculty_id').html('<option value="">Loading...</option>');

    if (paperId == '') {
        $('#faculty_id').html('<option value="">-- Select Faculty --</option>');
        return;
    }

    $.ajax({
        url: '/get-faculty-papers/' + paperId,
        type: 'GET',
        success: function (data) {

            var options = '<option value="">-- Select Faculty --</option>';

            $.each(data, function (i, faculty) {
                options += '<option value="' + faculty.emp_id + '">' +
                    faculty.faculty_name +
                    '</option>';
            });

            $('#faculty_id').html(options);
        }
    });

});

});
</script>






@endsection
