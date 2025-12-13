<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Video;

class UniquePaperStaffModule implements ValidationRule
{
    private $paper_id;
    private $emp_id;
    private $module_no;
    private $video_id;

    public function __construct($paper_id, $emp_id, $module_no, $video_id = null)
    {
        $this->paper_id = $paper_id;
        $this->emp_id = $emp_id;
        $this->module_no = $module_no;
        $this->video_id = $video_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Video::where('paper_id', $this->paper_id)
            ->where('emp_id', $this->emp_id)
            ->where('module_no', $this->module_no);

        // Exclude current record when updating
        if ($this->video_id) {
            $query->where('id', '!=', $this->video_id);
        }

        if ($query->exists()) {
            $fail('Duplicate entry! This combination of Paper, Staff, and Module already exists.');
        }
    }
}
