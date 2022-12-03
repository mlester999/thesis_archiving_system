<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Archive;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
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

    public $sortDirection = 'desc';

    public $showPublishModal = false;

    public $showResults = '5';

    public $studentId;

    public $documentPath;

    public $documentName;

    public $signaturePath;

    public $signatureName;

    public $archiveTitle;

    public $viewUser;

    public $currentUser;

    public $viewArchive;

    // Publishing Table
    public Archive $publishing;

    protected $rules = [
        'publishing.archive_status' => 'required|gt:0',
        'publishing.admin_comment' => 'nullable',
    ];

    public function mount() {
        $this->publishing = $this->makeBlankUser();
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function makeBlankUser() {
        return Archive::make();
    }

    public function edit(Archive $archive) {

        $this->viewArchive = Archive::find($archive->id);

        $this->viewUser = User::find($this->viewArchive->user_id);

        $this->resetErrorBag();

        if($this->publishing->isNot($archive)) $this->publishing = $archive;

        $this->showPublishModal = true;

        $this->studentId = $this->viewUser->student_id;

        $this->documentPath = $this->viewArchive->document_path;

        $this->documentName = $this->viewArchive->document_name;

        $this->signaturePath = $this->viewArchive->signature_path;

        $this->signatureName = $this->viewArchive->signature_name;

        $this->archiveTitle = "Publish Archive";
    }

    public function save() {
        // Validation of the inputs
        $this->validate();

        // Storing the pending thesis to google drive
        $fileSystem = Storage::disk('google');

        // If the thesis uploaded by the student was approved
        if($this->publishing->archive_status == 1) {

            $this->currentUser = User::find($this->publishing->user_id);

            // Adding Roles 
            $this->currentUser->removeRole('Seniors (Pending Thesis)');
            $this->currentUser->assignRole('Seniors (Approved Thesis)');

            // Moving the uploaded thesis from "For Approval" to "Approved Thesis"
            $fileUploaded = $fileSystem->move('For Approval' . '/' . $this->studentId . '/' . $this->documentName, 'Approved Thesis' . '/' . $this->studentId . '/' .  $this->documentName);
            $signatureUploaded = $fileSystem->move('For Approval' . '/' . $this->studentId . '/' . $this->signatureName, 'Approved Thesis' . '/' . $this->studentId . '/' .  $this->signatureName);
            
            // Changing the Thesis File Path
            $this->publishing->document_path = $fileSystem->url('Approved Thesis' . '/' . $this->studentId . '/' .  $this->documentName);
            
            // Changing the E-Signature Path
            $this->publishing->signature_path = $fileSystem->url('Approved Thesis' . '/' . $this->studentId . '/' .  $this->signatureName);
            
            if(!$fileSystem->files('For Approval' . '/' . $this->studentId)) {
                $fileSystem->delete('For Approval' . '/' . $this->studentId);
            }
        } 
        
        if($this->publishing->archive_status == 2) {
            // Deleting the Thesis File on "For Approval" folder.
            $fileSystem->delete('For Approval' . '/' . $this->studentId, $this->documentName);
            
            // Deleting the E-Signature File on "For Approval" folder.
            $fileSystem->delete('For Approval' . '/' . $this->studentId, $this->signatureName);
        }

        $this->publishing->save();

        $this->showPublishModal = false;

        $this->alert('success', $this->archiveTitle . ' ' . 'Successfully!');
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {

        return view('livewire.archive-list', [
            'archives' => Archive::leftJoin('departments', 'archives.department_id', '=', 'departments.id')
            ->leftJoin('curricula', 'archives.curriculum_id', '=', 'curricula.id')
            ->where('archive_code', 'like', '%'  . $this->search . '%')
            ->orWhere('title', 'like', '%'  . $this->search . '%')
            ->orWhere('year', 'like', '%'  . $this->search . '%')
            ->orWhere('dept_name', 'like', '%'  . $this->search . '%')
            ->orWhere('curr_name', 'like', '%'  . $this->search . '%')
            ->select('archives.id', 'archives.archive_code', 'archives.title', 'archives.year', 'archives.abstract', 'archives.members', 'archives.document_path', 'archives.document_name', 'archives.archive_status', 'archives.department_id', 'archives.curriculum_id', 'archives.user_id', 'archives.created_at', 'departments.dept_name', 'curricula.curr_name')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->showResults),
        ]);
    }
}
