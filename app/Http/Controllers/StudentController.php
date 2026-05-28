<?php



namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    

    public function index()
    {
        
        $students = Student::orderBy('created_at', 'desc')->get();
        $stats = [
            'total'    => $students->count(),
            'active'   => $students->where('status', 'Active')->count(),
            'avg_age'  => $students->count() ? round($students->avg('age'), 1) : null,
            'courses'  => $students->pluck('course')->unique()->count(),
        ];
        return view('students.index', compact('students', 'stats'));
    }

    public function create()
    {
       
        return view('students.create');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email',
            'age'        => 'required|integer|min:15|max:80',
            'course'     => 'required|string|max:255',
            'year_level' => 'required|string|max:50',
            'section'    => 'nullable|string|max:50',
            'phone'      => 'nullable|string|max:20',
            'status'     => 'required|in:Active,Inactive,On Leave',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student "' . $validated['name'] . '" has been added successfully!');
    }

    public function edit(Student $student)
    {
        
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email,' . $student->id,
            'age'        => 'required|integer|min:15|max:80',
            'course'     => 'required|string|max:255',
            'year_level' => 'required|string|max:50',
            'section'    => 'nullable|string|max:50',
            'phone'      => 'nullable|string|max:20',
            'status'     => 'required|in:Active,Inactive,On Leave',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student "' . $student->name . '" has been updated successfully!');
    }

    public function destroy(Student $student)
    {
        
        $name = $student->name;
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student "' . $name . '" has been deleted.');
    }
}
