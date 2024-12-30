<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;

class AdminController extends Controller
{
    public function adminHome()
    {
        return view("admin.home.adminHome");
    }

    public function addCourse()
    {
        return view("admin.home.addCourse");
    }

    public function storeCourse(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'number_of_courses' => 'required|integer|min:1|max:5',
            // Add any additional validation rules for course titles and descriptions if needed
        ]);

        // Process the form data and save the courses to the database
        for ($i = 1; $i <= $validatedData['number_of_courses']; $i++) {
            $courseTitle = $request->input('course_title_' . $i);
            $courseDescription = $request->input('course_description_' . $i);

            // Save the course details to the database as per your application's requirements
            $course = new Course();
            $course->title = $courseTitle;
            $course->description = $courseDescription;
            $course->save();
        }

        // Redirect or show a success message
        return redirect()->back()->with('success', 'Course added successfully');
    }

    public function manageCourse()
    {
        $courses = Course::all();
        return view("admin.home.manageCourse", compact('courses'));
    }

    public function editCourse($id)
    {
        $course = Course::find($id);
        return view('admin.home.editCourse', compact('course'));
    }

    public function updateCourse(Request $req, $id)
    {
        $course = Course::find($id);
        $course->title = $req->title;
        $course->description = $req->description;
        if ($course->save()) {
            return redirect('admin/manage-courses');
        }
    }

    public function deleteCourse($id)
    {
        if (Course::find($id)->delete()) {
            return redirect('admin/manage-courses');
        }
    }

    public function users()
    {
        return view('admin.home.users');
    }

    public function getTeachers()
    {
        $teachers = Teacher::all();
        return view('admin.home.teachers', compact('teachers'));
    }

    public function searchTeacher(Request $request)
    {
        $search = $request->search_teacher;
        $teachers = Teacher::where(function ($query) use ($search) {

            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->get();

        return view('admin.home.teachers', compact('teachers', 'search'));
    }

    public function editTeacher($id)
    {
        $teacher = Teacher::find($id);
        return view('admin.home.editTeacher', compact('teacher'));
    }

    public function updateTeacher(Request $req, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->name = $req->name;
        $teacher->email = $req->email;
        if ($teacher->save()) {
            return redirect('admin/teachers');
        }
    }

    public function deleteTeacher($id)
    {
        if (Teacher::find($id)->delete()) {
            return redirect('admin/teachers');
        }
    }

    public function getStudents()
    {
        $students = Student::all();
        return view('admin.home.students', compact('students'));
    }

    public function searchStudent(Request $request)
    {
        $search = $request->search_student;
        $students = Student::where(function ($query) use ($search) {

            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->get();

        return view('admin.home.students', compact('students', 'search'));
    }

    public function editStudent($id)
    {
        $student = Student::find($id);
        return view('admin.home.editStudent', compact('student'));
    }

    public function updateStudent(Request $req, $id)
    {
        $student = Student::find($id);
        $student->name = $req->name;
        $student->email = $req->email;
        if ($student->save()) {
            return redirect('admin/students');
        }
    }

    public function deleteStudent($id)
    {
        if (Student::find($id)->delete()) {
            return redirect('admin/students');
        }
    }
}
