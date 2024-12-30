<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teacher_courses');
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
