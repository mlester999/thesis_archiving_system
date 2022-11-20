<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Department;
use App\Models\Archive;
use Maize\Markable\Models\Bookmark;
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

    public function Projects(Request $request) {
        $deptData = Department::all();
        
        if($deptData) {
            if($request->search) {
                $archiveData = Archive::where('archive_status', 1)->where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(5);
                activity('Search Title')->by($request->user)->event('search')->withProperties(['ip_address' => $request->ip()])->log($request->search)->subject($request->search);
            } else {
                $archiveData = Archive::where('archive_status', 1)->orderBy('created_at', 'desc')->paginate(5);
            }
            return view('projects', ["currentPage" => "projects"], compact('archiveData'));
        } else {
            return redirect()->route('home');
        }

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

        $fileUploaded = $fileSystem->putFileAs('For Approval' . '/' . $userUploaded->student_id, $fileContent, $fileContentName);

        Archive::create([
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

        Alert::success('Submit Successfully', 'Your file has been submitted.')->showConfirmButton('OK', '#2678c5')->autoClose(6000);

        activity('Submit Thesis')->by($request->user)->event('submit thesis')->withProperties(['ip_address' => $request->ip()])->log('Submit Thesis Successful');

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
        $archives = Archive::all()->where('user_id', $id);

        return view('archives-list', ["currentPage" => 'archives-list'], compact('archives'));
    }

    public function ViewArchives($id) {
        $userId = Auth::user()->id;
        $viewArchiveData = Archive::all()->where('archive_code', $id)->where('user_id', $userId)->first();
        if($viewArchiveData) {
        return view('view-archives', ["currentPage" => 'view-archives'], compact('viewArchiveData'));
        } else {
            return redirect()->route('archives');
        }
    }

    public function EditArchives($id) {
        
        $userId = Auth::user()->id;
        $editArchiveData = Archive::all()->where('archive_code', $id)->where('user_id', $userId)->first();

        if($editArchiveData) {
        return view('edit-archives', ["currentPage" => 'edit-archives'], compact('editArchiveData'));
        } else {
            return redirect()->route('archives');
        }
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

        $fileSystem->delete('For Approval' . '/' . $userData->student_id, $storeArchiveData->document_name);

        $fileUploaded = $fileSystem->putFileAs('For Approval' . '/' . $userData->student_id, $fileContent, $fileContentName);

        $storeArchiveData->year = $request->year;
        $storeArchiveData->title = $request->title;
        $storeArchiveData->abstract = $request->abstract;
        $storeArchiveData->members = $request->members;
        $storeArchiveData->document_path = $fileSystem->url($fileUploaded);
        $storeArchiveData->document_name = $fileContentName;

        $storeArchiveData->save();

        Alert::success('Thesis Updated Successfully')->showConfirmButton('OK', '#2678c5')->autoClose(6000);

        activity('Update Archive')->by($request->user)->event('update archive')->withProperties(['ip_address' => $request->ip()])->log('Update Archive Successful');

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

        Alert::success('Profile Updated Successfully')->showConfirmButton('OK', '#2678c5')->autoClose(6000);

        activity('Update Profile')->by($request->user)->event('update profile')->withProperties(['ip_address' => $request->ip()])->log('Update Profile Successful');

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

            Alert::success('Password Updated Successfully')->showConfirmButton('OK', '#2678c5')->autoClose(6000);

            activity('Update Password')->by($request->user)->event('update password')->withProperties(['ip_address' => $request->ip()])->log('Update Password Successful');

            return redirect()->route('home');

        } else {

            Alert::error('Update Password Failed', "Password do not match. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(6000);

            return redirect()->back();

        }
    }

    public function CollegeDepartments(Request $request, $dept) {
    
        $deptData = Department::all()->where('dept_name', strtoupper($dept))->first();
        
        if($deptData) {
            if($request->search) {
                $archives = Archive::where('department_id', $deptData->id)->where('archive_status', 1)->where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(5);
                activity('Search Title')->by($request->user)->event('search')->withProperties(['ip_address' => $request->ip()])->log($request->search)->subject($request->search);
            } else {
                $archives = Archive::where('department_id', $deptData->id)->where('archive_status', 1)->orderBy('created_at', 'desc')->paginate(5);
            }
            return view('department', ["currentPage" => $dept], compact('archives'));
        } else {
            return redirect()->route('home');
        }
    }

    public function ViewCollegeDepartments($dept, $id) {

        $user = auth()->user();

        $deptData = Department::all()->where('dept_name', strtoupper($dept))->first();
        
        $viewDepartmentData = Archive::all()->where('department_id', $deptData->id)->where('archive_code', $id)->first();

        $archives = Bookmark::has($viewDepartmentData, $user);
        
        if($viewDepartmentData) {
        return view('view-department', ["currentPage" => 'view-archives', 'hasBookmark' => $archives], compact(['viewDepartmentData', 'user']));
        } else {
            return redirect()->route('department', $dept);
        }
    }

    public function BookmarkDepartment(Request $request, $id) {

        $user = auth()->user();

        $viewDepartmentData = Archive::find($id);

        Bookmark::toggle($viewDepartmentData, $user);

        activity('Bookmark')->by($request->user)->event('bookmark')->withProperties(['ip_address' => $request->ip()])->log('Bookmark Successful');

        return redirect()->back();
    }

    public function BookmarksList() {

        $archives = Archive::whereHasBookmark(
            auth()->user()
        )->paginate(5);

        return view('bookmarks', ["currentPage" => 'bookmarks'], compact('archives'));

    }

    public function DownloadThesis(Request $request, $id) {
        $viewDepartmentData = Archive::find($id);

        activity('Download Thesis')->by($request->user)->event('download thesis')->withProperties(['ip_address' => $request->ip()])->log('Download Thesis Successful');

        return redirect()->away($viewDepartmentData->document_path);
    }
}
