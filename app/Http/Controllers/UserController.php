<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Archive;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ResearchAgenda;
use Maize\Markable\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;
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

            if($request->search) {
                activity('Search Title')->by($request->user)->event('search')->withProperties(['ip_address' => $request->ip()])->log($request->search)->subject($request->search);
            }
            return view('projects', ["currentPage" => "projects", "currentSearch" => $request->search]);
    }

    public function SubmitThesis() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        $agendaData = ResearchAgenda::all();

        return view('submit-thesis', ["currentPage" => 'submit'], compact(['userData', 'agendaData']));

    }

    public function StoreThesis(Request $request) {
        $id = Auth::user()->id;
        $userUploaded = User::find($id);
        $agendaData = ResearchAgenda::all()->where('agenda_name', $request->research_agenda)->first();
        $uploadedData = Archive::all()->where('user_id', $userUploaded->id)->last();

        if(!empty($request->file('document_path'))) {

            if($request->file('document_path')->getSize() > 10000000) {
                Alert::error('Maximum of 10MB only', 'Your file size is too big.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }

            if($request->file('document_path')->getClientMimeType() !== 'application/pdf') {
                Alert::error('PDF File Only', 'Your file is an invalid file type.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }
        }   

        if(!empty($request->file('signature_path'))) {

            if($request->file('signature_path')->getSize() > 10000000) {
                Alert::error('Maximum of 10MB only', 'Your file size is too big.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }

            if($request->file('signature_path')->getClientMimeType() !== 'application/pdf') {
                Alert::error('PDF File Only', 'Your file is an invalid file type.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }
        }

        $validatedInputs = $request->validate([
            'year' => 'required|integer',
            'title' => 'required',
            'research_agenda' => 'required',
            'abstract' => 'required',
            'members' => 'required',
            'document_path' => 'required',
            'signature_path' => 'required',
        ]);

        // Thesis File
        $fileContent = $request->file('document_path');

        // E-Signature File
        $signatureContent = $request->file('signature_path');

        // Thesis Name
        $fileContentName = $request->file('document_path')->getClientOriginalName();
        
        // E-Signature Name
        $signatureContentName = $request->file('signature_path')->getClientOriginalName();

        $fileSystem = Storage::disk('google');

        // Uploading of Thesis File
        $fileUploaded = $fileSystem->putFileAs('For Approval' . '/' . $userUploaded->student_id, $fileContent, $fileContentName);
        
        // Uploading of E-Signature File
        $signatureUploaded = $fileSystem->putFileAs('For Approval' . '/' . $userUploaded->student_id, $signatureContent, $signatureContentName);

        if($uploadedData == null || $uploadedData->archive_status > 1) {

        Archive::create([
            'curriculum_id' => $userUploaded->curriculum_id,
            'department_id' => $userUploaded->department_id,
            'research_agenda_id' => $agendaData->id,
            'year' => $request->year,
            'title' => $request->title,
            'abstract' => $request->abstract,
            'members' => $request->members,
            'document_path' => $fileSystem->url($fileUploaded),
            'document_name' => $fileContentName,
            'signature_path' => $fileSystem->url($signatureUploaded),
            'signature_name' => $signatureContentName,
            'user_id' => $userUploaded->id,
        ]);
            Alert::success('Submit Successfully', 'Your file has been submitted.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
            
            activity('Submit Thesis')->by($request->user)->event('submit thesis')->withProperties(['ip_address' => $request->ip()])->log('Submit Thesis Successful');
        } else {
            Alert::error('You have a pending thesis already', 'Please wait for the feedback.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
        }

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
        $archives = Archive::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

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
        $agendaData = ResearchAgenda::all();

        if($editArchiveData) {
        return view('edit-archives', ["currentPage" => 'edit-archives'], compact(['editArchiveData', 'agendaData']));
        } else {
            return redirect()->route('archives');
        }
    }

    public function UpdateArchives(Request $request, $id) {

        $storeArchiveData = Archive::findOrFail($id);

        $userData = User::find($storeArchiveData->user_id);

        $agendaData = ResearchAgenda::all()->where('agenda_name', $request->research_agenda)->first();

        if(!empty($request->file('document_path'))) {

            if($request->file('document_path')->getSize() > 10000000) {
                Alert::error('Maximum of 10MB only', 'Your file size is too big.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }

            if($request->file('document_path')->getClientMimeType() !== 'application/pdf') {
                Alert::error('PDF File Only', 'Your file is an invalid file type.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }
        }

        if(!empty($request->file('signature_path'))) {

            if($request->file('signature_path')->getSize() > 10000000) {
                Alert::error('Maximum of 10MB only', 'Your file size is too big.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }

            if($request->file('signature_path')->getClientMimeType() !== 'application/pdf') {
                Alert::error('PDF File Only', 'Your file is an invalid file type.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                return redirect()->back();
            }
        }

        $validatedInputs = $request->validate([
            'year' => 'required|integer',
            'title' => 'required',
            'research_agenda' => 'required',
            'abstract' => 'required',
            'members' => 'required',
            'document_path' => 'required',
            'signature_path' => 'required',
        ]);

        // Thesis File
        $fileContent = $request->file('document_path');

        // E-Signature File
        $signatureContent = $request->file('signature_path');

        // Thesis Name
        $fileContentName = $request->file('document_path')->getClientOriginalName();
        
        // E-Signature Name
        $signatureContentName = $request->file('signature_path')->getClientOriginalName();

        $fileSystem = Storage::disk('google');

        $fileSystem->delete('For Approval' . '/' . $userData->student_id, $storeArchiveData->document_name);

        $fileSystem->delete('For Approval' . '/' . $userData->student_id, $storeArchiveData->signature_name);

        // Uploading of Thesis File
        $fileUploaded = $fileSystem->putFileAs('For Approval' . '/' . $userData->student_id, $fileContent, $fileContentName);
    
        // Uploading of E-Signature File
        $signatureUploaded = $fileSystem->putFileAs('For Approval' . '/' . $userData->student_id, $signatureContent, $signatureContentName);

        $storeArchiveData->year = $request->year;
        $storeArchiveData->title = $request->title;
        $storeArchiveData->research_agenda_id = $agendaData->id;
        $storeArchiveData->abstract = $request->abstract;
        $storeArchiveData->members = $request->members;
        $storeArchiveData->document_path = $fileSystem->url($fileUploaded);
        $storeArchiveData->document_name = $fileContentName;
        $storeArchiveData->signature_path = $fileSystem->url($signatureUploaded);
        $storeArchiveData->signature_name = $signatureContentName;

        $storeArchiveData->save();

        Alert::success('Updated Successfully', 'Your thesis has been updated.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);

        activity('Update Archive')->by($request->user)->event('update archive')->withProperties(['ip_address' => $request->ip()])->log('Update Archive Successful');

        return redirect()->route('archives');
    }
    

    public function StoreProfile(Request $request) {
        $id = Auth::user()->id;
        $storeUserData = User::find($id);

        $validatedInputs = $request->validate([
            'first_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'middle_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'last_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'gender' => 'required',
            'student_id' => 'required|integer|digits:7|unique:users,student_id,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $storeUserData->first_name = $validatedInputs['first_name'];

        $storeUserData->middle_name = $validatedInputs['middle_name'];
        
        $storeUserData->last_name = $validatedInputs['last_name'];

        $storeUserData->gender = $validatedInputs['gender'];

        $storeUserData->student_id = $validatedInputs['student_id'];

        $storeUserData->email = $validatedInputs['email'];

        $storeUserData->save();

        Alert::success('Updated Successfully', 'Your profile has been updated.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);

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

            Alert::success('Updated Successfully', 'Your password has been updated.')->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);

            activity('Update Password')->by($request->user)->event('update password')->withProperties(['ip_address' => $request->ip()])->log('Update Password Successful');

            return redirect()->route('home');

        } else {

            Alert::error('Update Password Failed', "Password do not match. Please try again.")->width('420px')->showConfirmButton('OK', '#2678c5')->autoClose(5000);

            return redirect()->back();

        }
    }

    public function CollegeDepartments(Request $request, $dept) {
    
        $deptData = Department::all()->where('dept_name', strtoupper($dept))->first();

        if($deptData) {
            if($request->search) {
                activity('Search Title')->by($request->user)->event('search')->withProperties(['ip_address' => $request->ip()])->log($request->search)->subject($request->search);
            }
            return view('department', ["currentPage" => $dept, "currentDeptId" => $deptData->id, "currentSearch" => $request->search]);
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

        activity('Download Thesis')->by($request->user)->event('download thesis')->withProperties(['ip_address' => $request->ip()])->log($viewDepartmentData->title);

        return redirect()->away($viewDepartmentData->document_path);
    }
}
