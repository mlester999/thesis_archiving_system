<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        $userData = Archive::all()->where('user_id', $id);

        return view('projects', ["currentPage" => 'projects'], compact('userData'));

    }

    public function SubmitThesis() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('submit-thesis', ["currentPage" => 'submit'], compact('userData'));

    }

    public function StoreThesis(Request $request) {
        $id = Auth::user()->id;
        $userUploaded = User::find($id);
        $now = new DateTime();

        $validatedInputs = $request->validate([
            'year' => 'required|integer',
            'title' => 'required',
            'abstract' => 'required',
            'members' => 'required',
            'document_path' => 'required',
        ]);

        $fileContent = $request->file('document_path');
        $fileContentName = $request->file('document_path')->getClientOriginalName();

        $fileSystem = Storage::disk('google');

        $fileUploaded = $fileSystem->putFileAs($userUploaded->student_id, $fileContent, $fileContentName);

        $archiveFiles = Archive::create([
            'archive_code' => $now->format("Ym") . str_pad(Archive::count() + 1, 4, '0', STR_PAD_LEFT),
            'curriculum_id' => $userUploaded->curriculum_id,
            'department_id' => $userUploaded->department_id,
            'year' => $request->year,
            'title' => $request->title,
            'abstract' => $request->abstract,
            'members' => $request->members,
            'document_path' => $fileSystem->url($fileUploaded),
            'document_name' => $fileContentName,
            'user_id' => $userUploaded->id,
        ]);

        return redirect()->route('archives');
        
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

    public function ArchivesList() {
        
        $id = Auth::user()->id;
        $archiveData = Archive::all()->where('user_id', $id);

        return view('archives-list', ["currentPage" => 'archives-list'], compact('archiveData'));
    }

    public function ViewArchives($id) {
        
        $viewArchiveData = Archive::findOrFail($id);

        return view('view-archives', ["currentPage" => 'view-archives'], compact('viewArchiveData'));
    }

    public function EditArchives($id) {
        
        $editArchiveData = Archive::findOrFail($id);

        return view('edit-archives', ["currentPage" => 'edit-archives'], compact('editArchiveData'));
    }

    public function UpdateArchives(Request $request, $id) {

        $storeArchiveData = Archive::findOrFail($id);

        $userData = User::find($storeArchiveData->user_id);

        $validatedInputs = $request->validate([
            'year' => 'required|integer',
            'title' => 'required',
            'abstract' => 'required',
            'members' => 'required',
            'document_path' => 'required',
        ]);

        $fileContent = $request->file('document_path');
        $fileContentName = $request->file('document_path')->getClientOriginalName();

        $fileSystem = Storage::disk('google');

        $fileSystem->delete($userData->student_id, $storeArchiveData->document_name);

        $fileUploaded = $fileSystem->putFileAs($userData->student_id, $fileContent, $fileContentName);

        $storeArchiveData->year = $request->year;
        $storeArchiveData->title = $request->title;
        $storeArchiveData->abstract = $request->abstract;
        $storeArchiveData->members = $request->members;
        $storeArchiveData->document_path = $fileSystem->url($fileUploaded);
        $storeArchiveData->document_name = $fileContentName;

        $storeArchiveData->save();

        Alert::success('Profile Updated Successfully')->showConfirmButton('Okay', '#2678c5')->autoClose(6000);

        return redirect()->route('view.archives', $storeArchiveData->id);
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

    public function DeptCHAS () {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('department-chas', ["currentPage" => 'chas'], compact('userData'));
    }

    public function DeptCEAS () {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('department-ceas', ["currentPage" => 'ceas'], compact('userData'));
    }

    public function DeptCBAA () {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('department-cbaa', ["currentPage" => 'cbaa'], compact('userData'));
    }

    public function DeptMAE () {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('department-mae', ["currentPage" => 'mae'], compact('userData'));
    }

    public function DeptMBA () {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('department-mba', ["currentPage" => 'mba'], compact('userData'));
    }
}
