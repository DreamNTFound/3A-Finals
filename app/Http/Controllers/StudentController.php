<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $fields = [];
        $students = Student::query();

        if ($request->get('search')) {
            $students->where('firstname', 'like', "{$request->get('search')}%")
                ->orWhere('lastname', 'like', "{$request->get('search')}%");
        }

        if ($request->get('count')) {
            $students->where('count', $request->get('count'));
        }

        if ($request->get('limit')) {
            $students->where('limit', $request->get('limit'));
        }

        if ($request->get('offset')) {
            $students->where('offset', $request->get('offset'));
        }

        if ($request->get('sort') && $request->get('direction')) {
            $students->orderBy($request->get('sort'), $request->get('direction'));
        }

        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
            $students->select($fields);
        }

        if ($request->get('year')) {
            $students->where('year', $request->get('year'));
        }

        if ($request->get('course')) {
            $students->where('course', $request->get('course'));
        }

        if ($request->get('section')) {
            $students->where('section', $request->get('section'));
        }

        return response()->json([$fields ? $students->get($fields): $students->get(), 'greetings'=>'hello']);
    }

    public function select($id)
    {
        try {
            return response()->json(Student::findOrFail($id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function register(Request $request)
    {
        $newStudent = Student::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'year' => $request->year,
            'course' => $request->course,
            'sex' => $request->sex,
            'address' => $request->address,
            'section' => $request->section,
        ]);

        $student = Student::query();
        return response()->json([$student->where('id', '=', $newStudent->id)->get(), 'message'=>'User created!'], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::query()->where('id', '=', $id);
        $student->update($request->all());
        return response()->json([$student->get(), 'message'=>'User update!'], 200);
    }
}
