<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
        catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($id)
    {
        try {
            Student::query()
                ->where('id',$id)
                ->delete();

            return redirect()->route('list');
        }
        catch (\Exception $e) {
            return $e;
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
        try {
            Student::query()
                ->where('id',$request->id)
                ->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'age'=>$request->age,
                    'course'=>$request->course,
                ]);

            return redirect()->route('list');

        }
        catch (\Exception $e) {
            return $e;
        }
    }
}

