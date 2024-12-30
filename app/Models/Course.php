<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_courses');
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    public function examTimetables()
    {
        return $this->hasMany(ExamTimetable::class);
    }
}
