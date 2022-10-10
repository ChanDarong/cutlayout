<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.profile');
    }

    public function edit(){
        return view('profile.edit');
    }

    public function update(Request $request){

        $user_id = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
            Rule::unique('users')->ignore($user_id, 'id')], // to agnore this user id
            'avatar' => 'image',
        ]);

        $user = Auth::user();

        $imagePath = ($user->avatar) ? $user->avatar : null;
        $oldPath = ($user->avatar) ? '/storage/' . $user->avatar : null;
        if($request['avatar']){
            if($oldPath){
                $file =public_path($oldPath);
                unlink($file);
            }
            $imagePath = $request['avatar']->store('/', 'public');
        }
        // dd($request);
        //    $data = auth()->user();
        // dd($imagePath);
        // $user = Auth::user();
        // // dd($user);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->avatar = $imagePath;
        $user->save();
        // dd($user);

        // $newImagePath = request('avatar')->store('/', 'public');
        // $imagearray = ['avatar'=>$newImagePath];

        // $user = User::update(array_merge(
        //     $data,
        //     $imagearray
        // ));

        // dd($user);

        Alert::success('Success', 'User profile has been updated successfully.')->autoClose(3000);

        return redirect('/profile');
    }

    public function formpassword(){
        return view('profile.changepassword');
    }

    public function changepassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if(Hash::check($request->current_password, Auth::user()->password)){
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            Alert::success('Success', 'Password been updated successfully.')->autoClose(3000);
            return redirect()->back()->with('success', 'Password has been changed successfully.');
        }
        else{
            Alert::error('Fail', 'Incorrect Password.')->autoClose(3000);

            return redirect()->back()->with('error', 'Password is incorrect.');
        }
    }
}
