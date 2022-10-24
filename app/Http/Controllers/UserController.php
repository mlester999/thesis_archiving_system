<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function Projects() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('projects', ["currentPage" => 'projects'], compact('userData'));

    }

    public function SubmitThesis() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('submit-thesis', ["currentPage" => 'submit'], compact('userData'));

    }

    public function About() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('about', ["currentPage" => 'about'], compact('userData'));

    }

    public function Profile() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('profile', ["currentPage" => 'profile'], compact('userData'));

    }

    public function EditProfile() {
        $id = Auth::user()->id;
        $editUserData = User::find($id);

        return view('profile-edit', ["currentPage" => 'edit-profile'], compact('editUserData'));
    }

    public function StoreProfile(Request $request) {
        $id = Auth::user()->id;
        $storeUserData = User::find($id);

        $validatedInputs = $request->validate([
            'first_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'last_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'student_id' => 'required|integer',
            'email' => ['required', 'email'],
        ]);

        $storeUserData->first_name = $validatedInputs['first_name'];
        
        $storeUserData->last_name = $validatedInputs['last_name'];

        $storeUserData->student_id = $validatedInputs['student_id'];

        $storeUserData->email = $validatedInputs['email'];

        $storeUserData->save();

        Alert::success('Profile Updated Successfully')->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

        return redirect()->route('profile');
    }

    public function ChangePassword() {

        return view("change-password", ["currentPage" => 'change-password']);

    }

    public function UpdatePassword(Request $request) {

        $validateData = $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmNewPassword' => 'required|same:newPassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->currentPassword, $hashedPassword)) {
            $id = Auth::user()->id;

            $user = User::find($id);

            $user->password = bcrypt($request->newPassword);

            $user->save();

            Alert::success('Password Updated Successfully')->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

            return redirect()->route('home');

        } else {

            Alert::error('Update Password Failed', "Password do not match. Please try again.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

            return redirect()->back();

        }
    }

    public function DeptCCE () {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('department-cce', ["currentPage" => 'cce'], compact('userData'));
    }
}
