<?php
namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;

class LecCoursesController extends Controller
{
    public function index()
    {
        $courses = [
            [
                'name' => 'Accounting',
                'code' => 'ACC101',
                'description' => 'This course is designed to provide students with a basic understanding of financial accounting concepts and principles.',
            ],
            [
                'name' => 'Business Studies',
                'code' => 'BUS101',
                'description' => 'This course is designed to provide students with a basic understanding of business concepts and principles.',
            ],
            [
                'name' => 'Economics',
                'code' => 'ECO101',
                'description' => 'This course is designed to provide students with a basic understanding of economic concepts and principles.',
            ],
        ];
        return view('lecturer.course.index', compact('courses'));
    }
}