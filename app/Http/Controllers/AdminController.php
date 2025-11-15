<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function list()
    {
        $students = Student::all();
        return view('list',compact('students'));
    }

    public function store(Request $request)
    {
        try {

            Student::query()->create([
                'name'=>$request->name,
                'email'=>$request->email,
                'age'=>$request->age,
                'course'=>$request->course,
            ]);

            return redirect()->route('list');

        }
        catch (Exception $e) {
            return $e;
        }
    }

    public function delete($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete student.'
            ], 500);
        }
    }

    public function edit($id)
    {
        $student = Student::query()
            ->where('id',$id)
            ->first();

        return view('update',compact('student'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students,email,' . $request->id,
            'age'    => 'required|integer|min:1|max:100',
            'course' => 'required|string|max:255',
        ]);

        // ← USE THIS LINE (either one)
        Student::where('id', $request->id)
            ->update($request->only(['name', 'email', 'age', 'course']));

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully!'
        ]);
    }

    public function editForm($id)
    {
        $student = Student::findOrFail($id);
        return view('update', compact('student'));
    }

    public function viewForm($id)
    {
        $student = Student::findOrFail($id);
        return view('partials.view-student', compact('student'));
    }
}

