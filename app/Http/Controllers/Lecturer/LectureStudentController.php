<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Http\Request;

class LectureStudentController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user();
        
        $course = Course::where('lecturer_id', $lecturer->id)->first();

        if (!$course) {
            return redirect()->route('lecturer.dashboard');
        }

        $students = Student::whereHas('course', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('lecturer.students.index', compact('students'));
    }
}
