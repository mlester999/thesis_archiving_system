<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserList extends Component
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
    public $name;
    public $username;
    public $email;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public Admin $editing;

    protected $rules = [
        'editing.name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.username' => 'required|unique',
        'editing.email' => 'required|email|unique',
    ];

    public function mount() {
        $this->editing = $this->makeBlankUser();
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function create() {

        $this->resetErrorBag();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->showEditModal = true;

        $this->userTitle = "Add User";
    }

    public function view($user) {
        $this->viewUser = Admin::find($user);

        $this->name = $this->viewUser->name;

        $this->username = $this->viewUser->username;

        $this->email = $this->viewUser->email;

        $this->showViewModal = true;

        $this->userTitle = "User Info";
    }

    public function makeBlankUser() {
        return Admin::make();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(Admin $user) {

        $this->resetErrorBag();

        if($this->editing->isNot($user)) $this->editing = $user;

        $this->showEditModal = true;

        $this->userTitle = "Edit User";
    }

    public function save() {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;

        $this->alert('success', $this->userTitle . ' ' . 'Successfully!');
    }

    public function delete($user) {
        $this->deleteUser = Admin::find($user);

        $this->showDeleteModal = true;

        $this->userTitle = "Delete User";
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

        return view('livewire.user-list', [
            'users' => Admin::where('name', 'like', '%'  . $this->search . '%')
                    ->orWhere('username', 'like', '%'  . $this->search . '%')
                    ->orWhere('email', 'like', '%'  . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortDirection)->paginate(5),
        ]);
    }
}
