<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.profile')->with($notification);
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

            $notification = array(
                'message' => 'Admin Update Password Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('admin.dashboard')->with($notification);

        } else {

            $notification = array(
                'message' => "Current Password doesn't match",
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);

        }

    }

    public function UserList() {
        return view('admin.admin-user-list');
    }
}
