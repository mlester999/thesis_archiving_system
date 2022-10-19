<?php

namespace App\Http\Livewire;

use App\Models\User;
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

    public $deleteUser;

    public $showDeleteModal = false;

    public $showEditModal = false;

    public User $editing;

    protected $rules = [
        'editing.first_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.last_name' => 'required|regex:/^[\pL\s]+$/u|min:2',
        'editing.student_id' => 'required|numeric',
        'editing.email' => 'required|email',
    ];

    public function mount() {
        $this->editing = $this->makeBlankUser();
    }

    public function create() {

        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->showEditModal = true;
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

        if($this->editing->isNot($user)) $this->editing = $user;

        $this->showEditModal = true;
    }

    public function save() {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;

        $this->alert('success', 'User Edit Successfully!');
    }

    public function delete($user) {
        $this->deleteUser = User::find($user);

        $this->showDeleteModal = true;
    }

    public function deleteUser() {
        $this->deleteUser->delete();

        $this->showDeleteModal = false;

        $this->alert('success', 'User Deleted Successfully!');
    }


    public function render()
    {
        sleep(1);

        return view('livewire.user-list', [
            'users' => User::search('student_id', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(5),
        ]);
    }
}
