<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Archive;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteRecord extends Component
{
    public $delete_id;
    public $user_id;
    public $student_id;
    public $archive;

    protected $listeners = ['deleteConfirmed' => 'deleteArchive'];

    public function mount() {
        $this->user_id = Auth::user()->id;
    }

    public function deleteConfirmation($id) {
        $this->delete_id = $id;

        $this->user = User::find($this->user_id);

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteArchive() {
        $archive = Archive::findorFail($this->delete_id);
        $archive->delete();

        $fileSystem = Storage::disk('google');
        $fileSystem->delete('For Approval' . '/' . $this->user->student_id);

        $this->dispatchBrowserEvent('archiveDeleted');
    }

    public function render()
    {
        return view('livewire.delete-record', [
            'archives' => Archive::where('user_id', $this->user_id)->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
