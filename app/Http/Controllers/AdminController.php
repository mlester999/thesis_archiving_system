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
            'name' => 'required|min:2',
            'username' => 'required|unique:admins,username,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);

        $storeAdminData->name = $validatedInputs['name'];

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
            'currentPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmNewPassword' => 'required|min:8|same:newPassword',
        ]);

        $hashedPassword = Auth::guard('admin')->user()->password;
        if(Hash::check($request->currentPassword, $hashedPassword)) {
            $id = Auth::guard('admin')->user()->id;

            $admin = Admin::find($id);

            $admin->password = bcrypt($request->newPassword);

            $admin->save();

            Alert::success('Password Updated Successfully')->showConfirmButton('Okay', '#2678c5')->autoClose(5000);

            return redirect()->route('admin.dashboard');

        } else {

            Alert::error('Update Password Failed', "The current password you entered is incorrect. Please try again.")->showConfirmButton('Okay', '#2678c5')->autoClose(5000);

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
}
