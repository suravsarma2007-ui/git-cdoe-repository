<?php

namespace App\Http\Controllers;

use App\Models\Paper;

class PptReportHelper
{
    /**
     * Get semester number from paper table using paper_id
     *
     * @param int $paper_id
     * @return int|string Semester number or '-' if not found
     */
    public static function getSemesterByPaperId($paper_id)
    {
        $paper = Paper::find($paper_id);
        return $paper ? ($paper->semester ?? '-') : '-';
    }
}
