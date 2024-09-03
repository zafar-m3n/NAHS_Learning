<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Http\Request;

class LectureStudentController extends Controller
{
    public function index()
    {
        $course = auth()->user()->lecturer->course_id;
        $students = Student::whereHas('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('lecturer.students.index', compact('students'));
    }
}
