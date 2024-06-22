<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function indexSubject(Request $request)
    {
        $fields = [];
        $subjects = Subject::query();

        if ($request->get('search')) {
            $subjects->where('name', 'like', "{$request->get('search')}%")
                ->orWhere('intructor', 'like', "{$request->get('search')}%");
        }

        if ($request->get('sort') && $request->get('direction')) {
            $subjects->orderBy($request->get('sort'), $request->get('direction'));
        }

        if ($request->get('limit')) {
            $subjects->where('limit', $request->get('limit'));
        }

        if ($request->get('offset')) {
            $subjects->where('offset', $request->get('offset'));
        }

        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
            $subjects->select($fields);
        }

        if ($request->get('remarks')) {
            $subjects->where('remarks', $request->get('remarks'));
        }
        
        return response()->json([$fields ? $subjects->get($fields): $subjects->get(), 'greetings'=>'hello']);
    }

    public function selectSubject($id)
    {
        try {
            return response()->json(Student::findOrFail($id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createSubject(Request $request)
    {
        $grade = $request->all();
        $grade['grades'] = $grade['grades'] ?? [];

        $newSubject = Subject::create($request->all());
        $subjects = Student::query();
        return response()->json([$subjects->where('id', '=', $newSubject->id)->get(), 'message'=>'Subject Added!'], 200);
    }

    public function updateSubject(Request $request, $id)
    {
        $subjects = Subject::query()->where('id', '=', $id);
        $grade = $request->all();
        $grade['grades'] = $grade['grades'] ?? $subjects->grades;

        return response()->json([$subjects->get(), 'message'=>'Subject Update!'], 200);
    }
}
