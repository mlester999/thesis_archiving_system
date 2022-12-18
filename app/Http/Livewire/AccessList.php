<?php

namespace App\Http\Livewire;

use App\Models\Access;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AccessList extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $accessTitle;

    public $deleteAccess;

    public $viewAccess;

    public $showResults = '5';

    // Viewing Access Info
    public $accessId;
    public $roleId;
    public $permissionId;
    public $description;
    public $access_status;
    public $createdAt;

    public $role;
    public $permission;
    public $oldAccess;

    public $countFalse = 0;

    public $accessOption;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public Access $editing;

    protected $rules = [
        'editing.role_id' => 'required',
        'editing.permissions' => 'required|array',
        'editing.permissions.*' => 'nullable',
        'editing.description' => 'nullable',
    ];

    public function mount() {
        $this->editing = $this->makeBlankAccess();

        $this->accessOption = [];
    }

    public function closeModal() {
        $this->showEditModal = false;
    }

    public function displayAccessOption() {
        $userRole = Role::find($this->editing->role_id);

        if($userRole) {

            if($userRole->user == 'student') {
                $this->accessOption = Permission::where('user', 'student')->get();
            }

            if($userRole->user == 'admin') {
                $this->accessOption = Permission::where('user', 'admin')->get();
            }
        } else {
            $this->accessOption = [];
        }
    }

    public function updatedEditingRoleId() {
        $userRole = Role::find($this->editing->role_id);

        if($userRole->user == 'student') {
            $this->accessOption = Permission::where('user', 'student')->get();
        }

        if($userRole->user == 'admin') {
            $this->accessOption = Permission::where('user', 'admin')->get();
        }
    }

    public function create() {

        $this->resetErrorBag();

        if ($this->editing->getKey()) {

            $this->editing = $this->makeBlankAccess();
    
            $this->displayAccessOption();

        }

        $this->showEditModal = true;

        $this->accessTitle = "Add Access";
    }

    public function view($access) {
        $this->viewAccess = Access::find($access);

        $this->accessId = $this->viewAccess->id;

        $this->roleId = $this->viewAccess->role_id;

        $this->permissionId = $this->viewAccess->permissions;

        $this->description = $this->viewAccess->description;

        $this->access_status = $this->viewAccess->status;

        $this->createdAt = $this->viewAccess->created_at;

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

        $this->editing = $this->makeBlankAccess();

        $this->resetErrorBag();

        if($this->editing->isNot($access)) $this->editing = $access;
        
        $permissionsKeys = array_keys(json_decode($this->editing->permissions, true));

        $permissionsValues = array_values(json_decode($this->editing->permissions, true));

        $this->editing->permissions = array_combine($permissionsKeys, $permissionsValues);

        $this->showEditModal = true;

        $this->accessTitle = "Edit Access";

        $this->displayAccessOption();
        
    }

    public function save() {

        $this->validate();
        
        foreach($this->editing->permissions as $key => $permission) {
            if(!$permission){
                $this->countFalse += 1;
            }
        }

        if($this->countFalse == count($this->editing->permissions)) {
            $this->editing->permissions = [];
            $this->countFalse = 0;
        }
        
        $this->validate();
        
        $this->editing->permissions = array_filter($this->editing->permissions, 'strlen');

        $this->editing->permissions = collect($this->editing->permissions)->sortKeys()->toArray();
        
        $this->role = Role::find($this->editing->role_id);

        foreach(collect($this->editing->permissions) as $key => $permission) {
            if($permission) {
                $this->permission[] = Permission::find($permission);
            }
        }

        $this->oldAccess = Access::find($this->editing->id);
        
        if(count(Access::where('id', $this->editing->id)->where('role_id', $this->editing->role_id)->get()) == 1 || count(Access::where('role_id', $this->editing->role_id)->get()) == 0) {
            
            foreach($this->permission as $permission) {
                if($permission) {
                    $allPermissions[] = $permission->name;
                }
            }
            
            $this->role->syncPermissions($allPermissions);

            $this->editing->permissions = json_encode($this->editing->permissions);

            $this->editing->save();

            $this->permission = [];

            $this->validatedPermissions = [];

            $this->role = null;
            
            $this->oldAccess = null;

            $this->countFalse = 0;

            $this->showEditModal = false;

            $this->alert('success', $this->accessTitle . ' ' . 'Successfully!');

        } else {
            $this->showEditModal = false;

            $this->alert('error', 'This data is already existing!');

            $this->editing = $this->makeBlankAccess();

            $this->displayAccessOption();
        }
    }

    public function disable($access) {
        $this->disableAccess = Access::find($access);

        $this->showDeleteModal = true;

        $this->access_status = $this->disableAccess->status;

        if($this->disableAccess->status) {
            $this->accessTitle = "Deactivate Access";
        } else {
            $this->accessTitle = "Activate Access";
        }
    }

    public function disableAccess() {

        if($this->disableAccess->status) {
            $this->disableAccess->status = '0';
        } else {
            $this->disableAccess->status = '1';
        }

        $this->disableAccess->save();

        $this->editing = $this->makeBlankAccess();

        $this->showDeleteModal = false;

        $this->alert('success', $this->accessTitle . ' ' . 'Successfully!');
    }


    public function render()
    {
        return view('livewire.access-list', [
            'accesses' => Access::leftJoin('roles', 'accesses.role_id', '=', 'roles.id')
                    ->leftJoin('permissions', 'accesses.permissions', '=', 'permissions.id')
                    ->where('roles.name', 'like', '%'  . $this->search . '%')
                    ->orWhere('permissions.name', 'like', '%'  . $this->search . '%')
                    ->orWhere('description', 'like', '%'  . $this->search . '%')
                    ->orWhere('status', 'like', '%'  . $this->search . '%')
                    ->select('accesses.id', 'accesses.permissions', 'accesses.description', 'accesses.status', 'accesses.created_at', 'roles.name as role_name', 'permissions.name as permission_name')
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->showResults),
            'roles' => Role::whereNot(function ($query) {
                $query->where('user', 'super admin');
            })->get(),
            'permissions' => Permission::all(),
        ]);
    }
}
