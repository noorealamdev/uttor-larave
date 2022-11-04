<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('backend.user.index', compact('users'));
    }


    public function create()
    {
        return view('backend.user.create');
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'phone' => ['required', 'digits:11', 'unique:users'],
            'password' => 'required|string',
            'about' => 'nullable|string',
        ]);


        $user = new User();
        $user->type = $request->input('type');
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->about = $request->input('about');
        $user->password = Hash::make($request->get('password'));

        if($request->hasFile('avatar')) {
            $inputImage = $request->file('avatar');
            $imageName = time() . '.' . $inputImage->extension();
            // Delete Image
            File::delete('uploads/'.$user->avatar);
            $inputImage->move(public_path('uploads'), $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        return redirect()->route('user.index')->with(['msg' => 'User Added Successfully', 'type' => 'success']);

    }


    public function edit($user_id)
    {
        $user = User::find($user_id);

        return view('backend.user.edit', compact('user'));
    }


    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => ['required', 'digits:11', 'unique:users'],
            'password' => 'required|string',
            'about' => 'nullable|string',
        ]);

        $user = User::find($user_id);

        $user->type = $request->input('type');
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->about = $request->input('about');
        $user->password = Hash::make($request->get('password'));

        if($request->hasFile('avatar')) {
            $inputImage = $request->file('avatar');
            $imageName = time() . '.' . $inputImage->extension();
            // Delete Image
            File::delete('uploads/'.$user->avatar);
            $inputImage->move(public_path('uploads'), $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        return redirect()->route('user.index')->with(['msg' => 'User Updated Successfully', 'type' => 'success']);
    }


    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return redirect()->route('user.index')->with(['msg' => 'User has been deleted', 'type' => 'success']);
    }
}
