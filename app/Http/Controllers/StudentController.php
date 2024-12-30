<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Course;
use App\Models\Enrolment;
use App\Models\ClassSchedule;
use App\Models\ExamTimetable;


class StudentController extends Controller
{
    public function studentHome()
    {
        return view('student.home.studentHome');
    }

    public function enroll()
    {
        $courses = Course::all();
        return view('student.home.enroll', compact('courses'));
    }

    public function storeEnrolment(Request $request)
    {

        $student = Session::get('s_id');

        // Validate the form data
        $validatedData = $request->validate([
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
        ]);

        // Process the selected courses
        $selectedCourses = $validatedData['courses'];

        // Perform any additional logic with the selected courses, such as saving to the database or performing actions on each course
        foreach ($selectedCourses as $course) {
            $enrollment = new Enrolment();
            $enrollment->student_id = $student;
            $enrollment->course_id = $course;
            $enrollment->save();
        }

        // Redirect or show a success message
        return redirect('student/home');
    }

    public function studentClassSchedule()
    {
        $studentId = Session::get('s_id');
        $enrollments = Enrolment::where('student_id', $studentId)->get();
        $schedules = ClassSchedule::whereIn('course_id', $enrollments->pluck('course_id'))->get();
        $routine = [];

        foreach ($schedules as $schedule) {
            $dayOfWeek = $schedule->day_of_week;
            $course = Course::find($schedule->course_id);

            if ($course) {
                $courseName = $course->title;
                $startTime = $schedule->start_time;
                $endTime = $schedule->end_time;

                if (!isset($routine[$dayOfWeek])) {
                    $routine[$dayOfWeek] = [];
                }

                $routine[$dayOfWeek][] = [
                    'courseName' => $courseName,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                ];
            }
        }

        // $routine now contains the grouped schedule data by week days
        // You can use this data to generate the routine table in your view or perform any other necessary actions

        return view('student.home.studentRoutine', compact('routine'));
    }

    public function studentExamSchedule()
    {
        $studentId = Session::get('s_id');
        $enrollments = Enrolment::where('student_id', $studentId)->get();
        $schedules = ExamTimetable::whereIn('course_id', $enrollments->pluck('course_id'))->get();
        $routine = [];
        foreach ($schedules as $schedule) {
            $course = Course::find($schedule->course_id);
            if ($course) {
                $courseID = $course->id;
                $courseName = $course->title;
                $examType = $schedule->exam_type;
                $date = $schedule->date;
                $startTime = $schedule->start_time;
                $endTime = $schedule->end_time;


                $routine[] = [
                    "course_id" => $courseID,
                    'course_name' => $courseName,
                    "exam_type" => $examType,
                    "date" => $date,
                    "start_time" => $startTime,
                    "end_time" => $endTime,
                ];
            }
        }
        return view('student.home.studentExamSchedule', compact('routine'));
    }
}
