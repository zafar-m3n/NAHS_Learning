<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive,terminated', // Validate status
        ]);

        // Fetch the course to get the lecturer_id
        $course = Course::findOrFail($request->course_id);
        $lecturer_id = $course->lecturer_id;

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
        ]);

        // Create the student and include lecturer_id and status
        Student::create([
            'user_id' => $user->id,
            'course_id' => $request->course_id,
            'lecturer_id' => $lecturer_id,
            'status' => $request->status, // Store the status
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:active,inactive,terminated',
        ]);

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : null,
        ]);

        $student->update([
            'course_id' => $request->course_id,
            'status' => $request->status, // Update the status
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }



    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $courses = Course::all();
        return view('admin.students.edit', compact('student', 'courses'));
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
