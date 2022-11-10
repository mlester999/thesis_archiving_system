<?php

namespace App\Http\Livewire;

use App\Models\Access;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AccessList extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'asc';

    public $accessTitle;

    public $deleteAccess;

    public $viewAccess;

    // Viewing Access Info
    public $accessId;
    public $roleId;
    public $permissionId;
    public $description;
    public $status;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public Access $editing;

    protected $rules = [
        'editing.role_id' => 'required',
        'editing.permission_id' => 'required',
        'editing.description' => 'required',
        'editing.status' => 'required',
    ];

    public function mount() {
        $this->editing = $this->makeBlankAccess();
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function create() {

        $this->resetErrorBag();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankAccess();

        $this->showEditModal = true;

        $this->accessTitle = "Add Access";
    }

    public function view($access) {
        $this->viewAccess = Access::find($access);

        $this->accessId = $this->viewAccess->id;

        $this->roleId = $this->viewAccess->role_id;

        $this->permissionId = $this->viewAccess->permission_id;

        $this->description = $this->viewAccess->description;

        $this->status = $this->viewAccess->status;

        $this->showViewModal = true;

        $this->accessTitle = "Access Info";
    }

    public function makeBlankAccess() {
        return Access::make();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(Access $access) {

        $this->resetErrorBag();

        if($this->editing->isNot($access)) $this->editing = $access;

        $this->showEditModal = true;

        $this->accessTitle = "Edit Access";
    }

    public function save() {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;

        $this->alert('success', $this->accessTitle . ' ' . 'Successfully!');
    }

    public function delete($access) {
        $this->deleteAccess = Access::find($access);

        $this->showDeleteModal = true;

        $this->accessTitle = "Delete Access";
    }

    public function deleteAccess() {
        $this->deleteAccess->delete();

        $this->editing = $this->makeBlankAccess();

        $this->showDeleteModal = false;

        $this->alert('success', $this->accessTitle . ' ' . 'Successfully!');
    }


    public function render()
    {
        sleep(1);

        return view('livewire.access-list', [
            'accesses' => Access::join('roles', 'accesses.role_id', '=', 'roles.id')
                    ->join('permissions', 'accesses.permission_id', '=', 'permissions.id')
                    ->where('roles.name', 'like', '%'  . $this->search . '%')
                    ->where('permissions.name', 'like', '%'  . $this->search . '%')
                    ->where('description', 'like', '%'  . $this->search . '%')
                    ->where('status', 'like', '%'  . $this->search . '%')
                    ->select('accesses.id', 'accesses.description', 'accesses.status', 'accesses.created_at', 'roles.name as role_name', 'permissions.name as permission_name')
                    ->orderBy($this->sortField, $this->sortDirection)->paginate(5),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }
}
