<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTimetable extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'exam_type', 'date', 'start_time', 'end_time'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
