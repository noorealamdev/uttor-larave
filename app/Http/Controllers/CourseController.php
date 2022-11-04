<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 1)->latest()->get();

        return view('backend.course.index', compact('courses'));
    }


    public function create()
    {
        $categories = Category::where('status', 1)->latest()->get();
        $teachers = User::where('type', 'teacher')->latest()->get();

        return view('backend.course.create', compact('categories', 'teachers'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'sale_price' => 'required',
        ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->category_id = $request->input('category_id');
        $course->teacher_id = $request->input('teacher_id');
        $course->sale_price = $request->input('sale_price');
        $course->regular_price = $request->input('regular_price');
        $course->description = $request->input('description');
        $course->features = trim($request->input('features'));
        $course->course_duration = $request->input('course_duration');
        $course->video_preview = $request->input('video_preview');
        $course->students_count = $request->input('students_count');
        $course->instructions = $request->input('instructions');
        $course->status = $request->input('status');

        if($request->hasFile('thumbnail')) {
            $inputImage = $request->file('thumbnail');
            $imageName = time() . '.' . $inputImage->extension();
            // Delete Image
            File::delete('uploads/'.$course->thumbnail);
            $inputImage->move(public_path('uploads'), $imageName);
            $course->thumbnail = $imageName;
        }

        $course->save();

        return redirect()->route('course.edit', $course->id )->with(['msg' => 'Course Added Successfully', 'type' => 'success']);

    }


    public function edit($course_id)
    {
        $course = Course::find($course_id);
        $categories = Category::where('status', 1)->latest()->get();
        $teachers = User::where('type', 'teacher')->latest()->get();

        return view('backend.course.edit', compact('course', 'categories', 'teachers'));
    }


    public function update(Request $request, $course_id)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'sale_price' => 'required',
            'course_type' => 'required',
        ]);

        $course = Course::find($course_id);
        $course->title = $request->input('title');
        $course->category_id = $request->input('category_id');
        $course->teacher_id = $request->input('teacher_id');
        $course->sale_price = $request->input('sale_price');
        $course->regular_price = $request->input('regular_price');
        $course->description = $request->input('description');
        $course->features = trim($request->input('features'));
        $course->course_duration = $request->input('course_duration');
        $course->video_preview = $request->input('video_preview');
        $course->students_count = $request->input('students_count');
        $course->instructions = $request->input('instructions');
        $course->status = $request->input('status');

        if($request->hasFile('thumbnail')) {
            $inputImage = $request->file('thumbnail');
            $imageName = time() . '.' . $inputImage->extension();
            // Delete Image
            File::delete('uploads/'.$course->thumbnail);
            $inputImage->move(public_path('uploads'), $imageName);
            $course->thumbnail = $imageName;
        }

        $course->save();

        return redirect()->route('course.index')->with(['msg' => 'Course Updated Successfully', 'type' => 'success']);
    }


    public function destroy($course_id)
    {
        $course = Course::find($course_id);
        $course->delete();

        return redirect()->route('course.index')->with(['msg' => 'Course has been deleted', 'type' => 'success']);
    }
}
