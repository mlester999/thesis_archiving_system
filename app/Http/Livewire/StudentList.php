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
    public $firstName;
    public $lastName;
    public $studentId;
    public $departmentId;
    public $curriculumId;
    public $email;

    public $curriculaOption;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public User $editing;

    protected $rules = [
        'editing.first_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.last_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.student_id' => 'required|numeric',
        'editing.department_id' => 'required',
        'editing.curriculum_id' => 'required',
        'editing.email' => 'required|email',
    ];

    public function mount() {
        $this->editing = $this->makeBlankUser();
        $this->editing->department_id = '0';

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

        $this->userTitle = "Add";

    }

    public function view($user) {
        $this->viewUser = User::find($user);

        $this->firstName = $this->viewUser->first_name;

        $this->lastName = $this->viewUser->last_name;

        $this->studentId = $this->viewUser->student_id;

        $this->departmentId = $this->viewUser->department_id;

        $this->curriculumId = $this->viewUser->curriculum_id;

        $this->email = $this->viewUser->email;

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

        $this->userTitle = "Edit";
    }

    public function save() {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;

        $this->alert('success', 'Student' . ' ' . $this->userTitle . ' ' . 'Successfully!');
    }

    public function delete($user) {
        $this->deleteUser = User::find($user);

        $this->showDeleteModal = true;
    }

    public function deleteUser() {
        $this->deleteUser->delete();

        $this->editing = $this->makeBlankUser();

        $this->showDeleteModal = false;

        $this->alert('success', 'Student Delete Successfully!');
    }

    public function render()
    {
        sleep(1);

        return view('livewire.student-list', [
            'users' => User::search(['student_id', 'last_name', 'first_name', 'email'], $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(5),
            'departments' => Department::all(),
            'curricula' => Curriculum::all(),
        ]);
    }
}
