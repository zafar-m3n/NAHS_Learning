<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ScheduleCourse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // ... existing code ...

    public function index()
    {
        $schedules = ScheduleCourse::all();
        return view('lecturer.schedule.index', compact('schedules'));
    }

    // ... existing code ...

    public function create()
    {
        return view('lecturer.schedule.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'day' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        ScheduleCourse::create($validatedData);

        return redirect()->route('schedule.index')->with('success', 'Schedule course created successfully.');
    }

    public function show(ScheduleCourse $scheduleCourse)
    {
        return view('lecturer.schedule.show', compact('scheduleCourse'));
    }

    public function edit(ScheduleCourse $scheduleCourse)
    {
        return view('lecturer.schedule.edit', compact('scheduleCourse'));
    }

    public function update(Request $request, ScheduleCourse $scheduleCourse)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'day' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $scheduleCourse->update($validatedData);

        return redirect()->route('schedule.index')->with('success', 'Schedule course updated successfully.');
    }

    public function destroy(ScheduleCourse $scheduleCourse)
    {
        $scheduleCourse->delete();

        return redirect()->route('schedule.index')->with('success', 'Schedule course deleted successfully.');
    }
}
