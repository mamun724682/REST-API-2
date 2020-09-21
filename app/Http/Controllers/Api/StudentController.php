<?php

namespace App\Http\Controllers\Api;

use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|max:25',
            'section_id' => 'required|max:25',
            'name' => 'required|max:25',
            'phone' => 'required|unique:students|max:25',
            'email' => 'required|email|unique:students|max:25',
            'password' => 'required|unique:students|max:25',
            'photo' => 'required',
            'address' => 'required|max:25',
            'gender' => 'required|max:25',
        ]);

        $data = [];
        $data['class_id'] = $request->class_id;
        $data['section_id'] = $request->section_id;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['photo'] = $request->photo;
        $data['address'] = $request->address;
        $data['gender'] = $request->gender;

        Student::create($data);

        return response('Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'max:25',
            'section_id' => 'unique:students|max:25',
            'name' => 'max:25',
            'phone' => 'unique:students|max:25',
            'email' => 'email|unique:students|max:25',
            'password' => 'unique:students|max:25',
            'photo' => 'unique:students',
            'address' => 'max:25',
            'gender' => 'max:25',
        ]);

        $data = [];
        $data['class_id'] = $request->class_id;
        $data['section_id'] = $request->section_id;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['photo'] = $request->photo;
        $data['address'] = $request->address;
        $data['gender'] = $request->gender;

        $student = Student::findOrFail($id);
        $student->update($data);

        return response('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $photo = $student->photo;
        unlink($photo);
        $student->delete();

        return response('Deleted Successfully!');
    }
}
