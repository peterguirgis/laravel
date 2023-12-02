<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class StudentController extends Controller
{

    public function index()
    {
        $student = Student::all();
        if (empty($student)) {
            $response = [
                "message" => "data not found",
            ];
        }else{
            $response = [
                "message" => "success",
                "data" => $student,
                "status" => 200
            ];
        }

        return response($response, 200) ;
    }




    public function store(Request $request)
    {
        // $student = Student::create($request->all);
        $request->validate([
            "name" => "required",
            "level" => "required",
            "gander" => "required",

        ]);
        $student = new Student();
        $student->name = $request->name;
        $student->level = $request->level;
        $student->gander = $request->gander;
        $student->save();
        $response = [
            "message" => "success",
            "data" => $student,
            "status" => 201
        ];
        return response($response, 200) ;
    }


    public function show($id)
    {
        $student = Student::find($id);
        if ($student == null) {
            $response = [
                "message" => "data not found",
            ];
        }else{
            $response = [
                "message" => "success",
                "data" => $student,
                "status" => 200
            ];
        }

        return response($response, 200) ;
    }




    public function update(Request $request,$id)
    {
        $request->validate([
            "name" => "required",
            "level" => "required",
            "gander" => "required",

        ]);
        $student = Student::find($id);

        if ($student == null) {
            $response = [
                "message" => "data not found",
            ];
        }else{
            $student->name = $request->name;
            $student->level = $request->level;
            $student->gander = $request->gander;
            $student->save();
            $response = [
                "message" => "success",
                "data" => $student,
                "status" => 200
            ];
        }
        return response($response, 200) ;
    }


    public function destroy($id)
    {
        $student = Student::find($id);
        $student ->delete();
        $response = [
            "message" => "success",
            "data" => $student,
            "status" => 201
        ];
        return response($response, 200);
    }
}
