<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function Profile() {
        $id = Auth::guard('admin')->user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin-profile-view',compact('adminData'));

    }

    public function EditProfile() {
        $id = Auth::guard('admin')->user()->id;
        $editAdminData = Admin::find($id);

        return view('admin.admin-profile-edit',compact('editAdminData'));
    }

    public function StoreProfile(Request $request) {
        $id = Auth::guard('admin')->user()->id;
        $storeAdminData = Admin::find($id);

        $validatedInputs = $request->validate([
            'first_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'last_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'username' => 'required',
            'email' => ['required', 'email'],
        ]);

        $storeAdminData->first_name = $validatedInputs['first_name'];
        
        $storeAdminData->last_name = $validatedInputs['last_name'];

        $storeAdminData->username = $validatedInputs['username'];

        $storeAdminData->email = $validatedInputs['email'];

        $storeAdminData->save();

        Alert::success('Admin Profile Updated Successfully')->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

        return redirect()->route('admin.profile');
    }

    public function ChangePassword() {

        return view("admin.admin-change-password");

    }

    public function UpdatePassword(Request $request) {

        $validateData = $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmNewPassword' => 'required|same:newPassword',
        ]);

        $hashedPassword = Auth::guard('admin')->user()->password;
        if(Hash::check($request->currentPassword, $hashedPassword)) {
            $id = Auth::guard('admin')->user()->id;

            $admin = Admin::find($id);

            $admin->password = bcrypt($request->newPassword);

            $admin->save();

            Alert::success('Admin Password Updated Successfully')->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

            return redirect()->route('admin.dashboard');

        } else {

            Alert::error('Update Password Failed', "Password do not match. Please try again.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

            return redirect()->back();

        }

    }

    public function ViewArchives($id) {
        
        $viewArchiveData = Archive::all()->where('archive_code', $id)->first();

        if($viewArchiveData) {
        return view('admin.admin-view-archives', compact('viewArchiveData'));
        } else {
            return redirect()->route('admin.archive-list');
        }
    }

    public function RegisterUser(Request $request) {
        $validatedInputs = $request->validate([
            'first_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'last_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'student_id' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create(request(['first_name', 'last_name', 'student_id', 'email', 'password']));
        
        auth()->login($user);

        session()->flash('message', 'User Added Successfully');

        return redirect()->back();
    }
}
