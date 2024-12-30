<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Course;
use App\Models\TeacherCourse;
use App\Models\ClassSchedule;
use App\Models\ExamTimetable;


class TeacherController extends Controller
{
    public function teacherHome()
    {
        return view('teacher.home.teacherHome');
    }

    public function addCourseMenu()
    {
        $courses = Course::all();
        return view('teacher.home.selectCourse', compact('courses'));
    }

    public function teacherCourses(Request $request)
    {
        $teacher = Session::get('t_id');
        // Validate the form data
        $validatedData = $request->validate([
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
        ]);

        // Process the selected courses
        $selectedCourses = $validatedData['courses'];
        // Perform any additional logic with the selected courses, such as saving to the database or performing actions on each course
        foreach ($selectedCourses as $course) {
            $teacherCourse = new TeacherCourse();
            $teacherCourse->teacher_id = $teacher;
            $teacherCourse->course_id = $course;
            $teacherCourse->save();
        }
        // Redirect or show a success message
        return redirect('teacher/home');
    }

    public function manageCourse()
    {
        $teacher = Session::get('t_id');
        $teacherCourses = TeacherCourse::all();
        $courses = [];
        foreach ($teacherCourses as $teacherCourse) {
            if ($teacher == $teacherCourse->teacher_id) {
                $course = Course::find($teacherCourse->course_id);
                if ($course) {
                    $courses[] = array('id' => $teacherCourse->id, 'c_id' => $teacherCourse->course_id, 'title' => $course->title);
                }
            }
        }

        return view('teacher.home.manageCourses', compact('teacher', 'courses'));
    }

    public function deleteCourse($id)
    {
        $course_id = TeacherCourse::find($id)->course_id;

        // dd(ClassSchedule::where('course_id', $course_id)->get());
        if (TeacherCourse::find($id)->delete()) {
            $class_schedules = ClassSchedule::where('course_id', $course_id)->get();
            foreach ($class_schedules as $schedule) {
                ClassSchedule::find($schedule->id)->delete();
            }
            $exam_schedules = ExamTimetable::where('course_id', $course_id)->get();
            foreach ($exam_schedules as $schedule) {
                ExamTimetable::find($schedule->id)->delete();
            }
            return redirect('teacher/manageCourse');
        }
    }

    public function routineMenu()
    {
        $teacher = Session::get('t_id');
        $teacherCourses = TeacherCourse::all();
        $courses = [];
        foreach ($teacherCourses as $teacherCourse) {
            if ($teacher == $teacherCourse->teacher_id) {
                $course = Course::find($teacherCourse->course_id);
                if ($course) {
                    $courses[] = array('c_id' => $teacherCourse->course_id, 'title' => $course->title);
                }
            }
        }
        return view('teacher.home.makeClassRoutine', compact('teacher', 'courses'));
    }

    public function routineEntry($id)
    {
        $course = Course::find($id);
        // dd($course);
        return view('teacher.home.routineSchedule', compact('course'));
    }

    public function classScheduleStore(Request $request, $id)
    {
        $course = Course::find($id);
        $teacher = Session::get('t_id');
        // Validate the form data
        $validatedData = $request->validate([
            'duration' => 'required|in:1,2',
        ]);

        $duration = $validatedData['duration'];

        // Loop through the dynamic fields based on the duration
        $schedule = [];
        for ($i = 1; $i <= $duration; $i++) {
            $dayOfWeek = $request->input('day_of_week_' . $i);
            $startTime = $request->input('start_time_' . $i);
            $endTime = $request->input('end_time_' . $i);

            // Perform any additional actions with the schedule data, such as saving to the database
            $schedule = new ClassSchedule();
            $schedule->course_id = $course->id;
            $schedule->teacher_id = $teacher;
            $schedule->day_of_week = $dayOfWeek;
            $schedule->start_time = $startTime;
            $schedule->end_time = $endTime;
            $schedule->save();
        }

        // Redirect or show a success message
        return redirect('teacher/home')->with('success', 'Class schedule inserted');
    }

    public function examMenu()
    {
        $teacherId = Session::get('t_id');
        $teacherCourses = TeacherCourse::where('teacher_id', $teacherId)->get();
        $courseIds = $teacherCourses->pluck('course_id')->toArray();
        $courses = Course::whereIn('id', $courseIds)->get();
        return view('teacher.home.teacherExamSchedule', compact('courses'));
    }

    public function examScheduleStore(Request $request)
    {
        $examTimetable = new ExamTimetable();
        $examTimetable->course_id = $request->selectedCourse;
        $examTimetable->exam_type = $request->examType;
        $examTimetable->date = $request->date;
        $examTimetable->start_time = $request->startTime;
        $examTimetable->end_time = $request->endTime;

        if ($examTimetable->save()) {
            return redirect('/teacher/home')->with('success', 'Exam schedule added');
        }
    }
}
