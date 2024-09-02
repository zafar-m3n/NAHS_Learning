<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->get();
        return view('admin.students.index', compact('students'));
    }
}
