<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function index()
    {
        if (Session::has("a_name")) {
            return redirect("/admin/home");
        } elseif (Session::has("s_id")) {
            return redirect("/student/home");
        } elseif (Session::has("t_id")) {
            return redirect("/teacher/home");
        } else {
            return view("index");
        }
    }

    public function adminLogin()
    {
        return view("admin.auth.loginAdmin");
    }

    public function adminLogger(Request $request)
    {
        $email = "contact@admin.com";
        $pass = "12345";
        if ($request->email == $email && $request->pass == $pass) {
            // Session::put('is_admin', 1);
            Session::put('a_name', 'Admin');
            Session::put('role', 'admin');
            return redirect('admin/home');
        }
    }

    public function studentLogin()
    {
        return view("student.auth.loginStudent");
    }

    public function studentRegister()
    {
        return view("student.auth.registerStudent");
    }

    public function studentRegistration(Request $request)
    {
        $student = new Student();

        $student_exists = Student::where('email', '=', $request->email)->first();

        if ($student_exists) {
            return redirect()->back()->with('error', 'Email exists');
        } else {
            $student->name = $request->username;
            $student->email = $request->email;
            $student->password = $request->password;

            if ($student->save()) {
                return redirect()->back()->with('success', 'Student registered, login to continue');
            }
        }
    }

    public function studentLogger(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $student = Student::where('email', '=', $email)
            ->where('password', '=', $password)->first();

        if ($student) {
            // Save info in session
            Session::put('s_id', $student->id);
            Session::put('s_name', $student->name);
            Session::put('s_email', $student->email);
            Session::put('role', 'student');
            return redirect('student/home');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function teacherRegister()
    {
        return view("teacher.auth.registerTeacher");
    }

    public function teacherRegistration(Request $request)
    {
        $teacher = new Teacher();

        $teacher_exists = Teacher::where('email', '=', $request->email)->first();

        if ($teacher_exists) {
            return redirect()->back()->with('error', 'Email exists');
        } else {
            $teacher->name = $request->username;
            $teacher->email = $request->email;
            $teacher->password = $request->password;

            if ($teacher->save()) {
                return redirect()->back()->with('success', 'teacher registered, login to continue');
            }
        }
    }

    public function teacherLogin()
    {
        return view('teacher.auth.loginTeacher');
    }

    public function teacherLogger(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $teacher = Teacher::where('email', '=', $email)
            ->where('password', '=', $password)->first();

        if ($teacher) {
            // Save info in session
            Session::put('t_id', $teacher->id);
            Session::put('t_name', $teacher->name);
            Session::put('t_email', $teacher->email);
            Session::put('role', 'teacher');
            return redirect('teacher/home');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
