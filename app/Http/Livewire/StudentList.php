<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentList extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'asc';

    public $userTitle;

    public $deleteUser;

    public $viewUser;

    // Viewing User Info
    public $userId;
    public $firstName;
    public $middleName;
    public $lastName;
    public $gender;
    public $studentId;
    public $departmentId;
    public $curriculumId;
    public $email;
    public $emailStatus;
    public $accStatus;

    public $curriculaOption;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public User $editing;

    protected $rules = [
        'editing.first_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.middle_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.last_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.gender' => 'required',
        'editing.student_id' => 'required|numeric',
        'editing.department_id' => 'required',
        'editing.curriculum_id' => 'required',
        'editing.email' => 'required|email',
        'editing.acc_status' => 'required|numeric|min:0',
    ];

    public function mount() {
        $this->editing = $this->makeBlankUser();

        $this->curriculaOption = [];

    }

    public function displayCurriculumOption() {
        if($this->editing->department_id != '') {
            $this->curriculaOption = Curriculum::where('department_id', $this->editing->department_id)->get();
        } else {
            $this->curriculaOption = [];
        }
    }

    public function updatedEditingDepartmentId() {
        if($this->editing->department_id != '') {
            $this->curriculaOption = Curriculum::where('department_id', $this->editing->department_id)->get();
        }
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function create() {
        $this->resetErrorBag();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->showEditModal = true;

        $this->userTitle = "Add Student";

        $this->displayCurriculumOption();

    }

    public function view($user) {
        $this->viewUser = User::find($user);

        $this->userId = $this->viewUser->id;

        $this->firstName = $this->viewUser->first_name;

        $this->middleName = $this->viewUser->middle_name;

        $this->lastName = $this->viewUser->last_name;

        $this->gender = $this->viewUser->gender;

        $this->studentId = $this->viewUser->student_id;

        $this->departmentId = $this->viewUser->department_id;

        $this->curriculumId = $this->viewUser->curriculum_id;

        $this->email = $this->viewUser->email;

        $this->emailStatus = $this->viewUser->email_status;

        $this->accStatus = $this->viewUser->acc_status;

        $this->showViewModal = true;

        $this->userTitle = "Student Info";
    }

    public function makeBlankUser() {
        return User::make();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(User $user) {
        $this->resetErrorBag();
        
        if($this->editing->isNot($user)) $this->editing = $user;
        
        $this->showEditModal = true;
        
        $this->userTitle = "Edit Student";

        $this->displayCurriculumOption();
    }

    public function save() {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;

        $this->alert('success', $this->userTitle . ' ' . 'Successfully!');
    }

    public function delete($user) {
        $this->deleteUser = User::find($user);

        $this->showDeleteModal = true;

        $this->userTitle = "Delete Student";
    }

    public function deleteUser() {
        $this->deleteUser->delete();

        $this->editing = $this->makeBlankUser();

        $this->showDeleteModal = false;

        $this->alert('success', $this->userTitle . ' ' . 'Successfully!');
    }

    public function render()
    {
        sleep(1);

        return view('livewire.student-list', [
            'users' => User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('curricula', 'users.curriculum_id', '=', 'curricula.id')
            ->where('student_id', 'like', '%'  . $this->search . '%')
            ->orWhere('last_name', 'like', '%'  . $this->search . '%')
            ->orWhere('first_name', 'like', '%'  . $this->search . '%')
            ->orWhere('dept_name', 'like', '%'  . $this->search . '%')
            ->orWhere('curr_name', 'like', '%'  . $this->search . '%')
            ->select('users.id', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.gender', 'users.email_status', 'users.acc_status', 'users.student_id', 'users.department_id', 'users.curriculum_id', 'users.created_at', 'departments.dept_name', 'curricula.curr_name')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5),
            'departments' => Department::all(),
            'curricula' => Curriculum::all(),
        ]);
    }
}
