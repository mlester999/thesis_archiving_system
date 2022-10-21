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

    public $sortDirection = 'asc';

    public $departmentTitle;

    public $deleteDepartment;

    public $viewDepartment;

    // Viewing User Info
    public $departmentId;
    public $name;
    public $description;
    public $status;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public Department $editing;

    protected $rules = [
        'editing.name' => 'required',
        'editing.description' => 'required',
        'editing.status' => 'required',
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

        $this->name = $this->viewDepartment->name;

        $this->description = $this->viewDepartment->description;

        $this->status = $this->viewDepartment->status;

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

        $this->editing->save();

        $this->showEditModal = false;

        $this->alert('success', $this->departmentTitle . ' ' . 'Successfully!');
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
        sleep(1);

        return view('livewire.department-list', [
            'departments' => Department::search(['id', 'name', 'description', 'status'], $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(5),
        ]);
    }
}
