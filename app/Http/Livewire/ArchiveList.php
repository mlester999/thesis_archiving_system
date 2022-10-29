<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Archive;
use Livewire\Component;
use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ArchiveList extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'asc';

    public $deleteArchive;

    public $viewArchive;

    // Viewing User Info
    public $archiveId;
    public $archiveCode;
    public $department_id;
    public $curriculum_id;
    public $title;
    public $abstract;
    public $year;
    public $members;
    public $document_path;
    public $document_name;
    public $status;
    public $user_id;

    // Modals
    public $showDeleteModal = false;

    public function view($archive) {
        $this->viewArchive = Archive::find($archive);

        $this->archiveId = $this->viewArchive->id;

        $this->archiveCode = $this->viewArchive->archiveCode;

        $this->department_id = $this->viewArchive->department_id;

        $this->curriculum_id = $this->viewArchive->curriculum_id;

        $this->title = $this->viewArchive->title;

        $this->abstract = $this->viewArchive->abstract;

        $this->year = $this->viewArchive->year;

        $this->members = $this->viewArchive->members;
        
        $this->document_path = $this->viewArchive->document_path;

        $this->document_name = $this->viewArchive->document_name;

        $this->status = $this->viewArchive->status;

        $this->user_id = $this->viewArchive->user_id;
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function delete($user) {
        $this->deleteUser = User::find($user);

        $this->showDeleteModal = true;
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

        return view('livewire.archive-list', [
            'archives' => Archive::join('departments', 'archives.department_id', '=', 'departments.id')
            ->join('curricula', 'archives.curriculum_id', '=', 'curricula.id')
            ->where('archive_code', 'like', '%'  . $this->search . '%')
            ->orWhere('title', 'like', '%'  . $this->search . '%')
            ->orWhere('year', 'like', '%'  . $this->search . '%')
            ->orWhere('dept_name', 'like', '%'  . $this->search . '%')
            ->orWhere('curr_name', 'like', '%'  . $this->search . '%')
            ->select('archives.id', 'archives.archive_code', 'archives.title', 'archives.year', 'archives.abstract', 'archives.members', 'archives.document_path', 'archives.document_name', 'archives.status', 'archives.department_id', 'archives.curriculum_id', 'archives.user_id', 'archives.created_at', 'departments.dept_name', 'curricula.curr_name')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5),
            'departments' => Department::all(),
            'curricula' => Curriculum::all(),
        ]);
    }
}
