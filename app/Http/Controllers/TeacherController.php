<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->get();

        return view('backend.teacher.index', compact('teachers'));
    }


    public function create()
    {
        return view('backend.teacher.create');
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'phone' => ['required', 'digits:11', 'unique:users'],
            'password' => 'required|string',
            'about' => 'nullable|string',
        ]);


        $teacher = new Teacher();
        $teacher->name = $request->input('name');
        $teacher->phone = $request->input('phone');
        $teacher->about = $request->input('about');
        $teacher->password = Hash::make($request->get('password'));

        if($request->hasFile('avatar')) {
            $inputImage = $request->file('avatar');
            $imageName = time() . '.' . $inputImage->extension();
            // Delete Image
            File::delete('uploads/'.$teacher->avatar);
            $inputImage->move(public_path('uploads'), $imageName);
            $teacher->avatar = $imageName;
        }

        $teacher->save();

        return redirect()->route('teacher.index')->with(['msg' => 'Teacher Added Successfully', 'type' => 'success']);

    }


    public function edit($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);

        return view('backend.teacher.edit', compact('teacher'));
    }


    public function update(Request $request, $teacher_id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => ['required', 'digits:11', 'unique:users'],
            'password' => 'required|string',
            'about' => 'nullable|string',
        ]);

        $teacher = Teacher::find($teacher_id);

        $teacher->name = $request->input('name');
        $teacher->phone = $request->input('phone');
        $teacher->about = $request->input('about');
        $teacher->password = Hash::make($request->get('password'));

        if($request->hasFile('avatar')) {
            $inputImage = $request->file('avatar');
            $imageName = time() . '.' . $inputImage->extension();
            // Delete Image
            File::delete('uploads/'.$teacher->avatar);
            $inputImage->move(public_path('uploads'), $imageName);
            $teacher->avatar = $imageName;
        }

        $teacher->save();

        return redirect()->route('teacher.index')->with(['msg' => 'Teacher Updated Successfully', 'type' => 'success']);
    }


    public function destroy($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        $teacher->delete();

        return redirect()->route('teacher.index')->with(['msg' => 'Teacher has been deleted', 'type' => 'success']);
    }
}
