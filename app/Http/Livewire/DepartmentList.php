<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use App\Models\Department;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DepartmentList extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $departmentTitle;

    public $deleteDepartment;

    public $viewDepartment;

    public $showResults = '5';

    // Viewing User Info
    public $departmentId;
    public $dept_name;
    public $dept_description;
    public $dept_status;
    public $createdAt;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public Department $editing;

    protected $rules = [
        'editing.dept_name' => 'required',
        'editing.dept_description' => 'required',
        'editing.dept_status' => 'required',
    ];

    public function mount() {
        $this->editing = $this->makeBlankDepartment();
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function create() {

        $this->resetErrorBag();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankDepartment();

        $this->showEditModal = true;

        $this->departmentTitle = "Add Department";
    }

    public function view($department) {
        $this->viewDepartment = Department::find($department);

        $this->departmentId = $this->viewDepartment->id;

        $this->dept_name = $this->viewDepartment->dept_name;

        $this->dept_description = $this->viewDepartment->dept_description;

        $this->dept_status = $this->viewDepartment->dept_status;

        $this->createdAt = $this->viewDepartment->created_at;

        $this->showViewModal = true;

        $this->departmentTitle = "Department Info";
    }

    public function makeBlankDepartment() {
        return Department::make();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(Department $department) {

        $this->resetErrorBag();

        if($this->editing->isNot($department)) $this->editing = $department;

        $this->showEditModal = true;

        $this->departmentTitle = "Edit Department";
    }

    public function save() {
        $this->validate();

        if(count(Department::where('id', $this->editing->id)->where('dept_name', $this->editing->dept_name)->where('dept_description', $this->editing->dept_description)->get()) == 1 || (count(Department::where('dept_description', $this->editing->dept_description)->get()) == 0 && count(Department::where('dept_name', $this->editing->dept_name)->get()) == 0)) {

            $this->editing->save();

            $this->showEditModal = false;

            $this->alert('success', $this->departmentTitle . ' ' . 'Successfully!');

        } else {
            $this->showEditModal = false;

            $this->alert('error', 'This data is already existing!');

            $this->editing = $this->makeBlankDepartment();
        }
    }

    public function delete($department) {
        $this->deleteDepartment = Department::find($department);

        $this->showDeleteModal = true;

        $this->departmentTitle = "Delete Department";
    }

    public function deleteDepartment() {
        $this->deleteDepartment->delete();

        $this->editing = $this->makeBlankDepartment();

        $this->showDeleteModal = false;

        $this->alert('success', $this->departmentTitle . ' ' . 'Successfully!');
    }


    public function render()
    {

        return view('livewire.department-list', [
            'departments' => Department::where('id', 'like', '%'  . $this->search . '%')
            ->orWhere('dept_name', 'like', '%'  . $this->search . '%')
            ->orWhere('dept_status', 'like', '%'  . $this->search . '%')
            ->orWhere('dept_description', 'like', '%'  . $this->search . '%')
            ->select('departments.id', 'departments.dept_name', 'departments.dept_status', 'departments.dept_description', 'departments.created_at')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->showResults),
        ]);
    }
}
