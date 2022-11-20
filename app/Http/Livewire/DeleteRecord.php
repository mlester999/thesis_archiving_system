<?php

namespace App\Http\Livewire;

use App\Models\Archive;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteRecord extends Component
{
    public $delete_id;
    public $user_id;

    protected $listeners = ['deleteConfirmed' => 'deleteArchive'];

    public function mount() {
        $this->user_id = Auth::user()->id;
    }

    public function deleteConfirmation($id) {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteArchive() {
        $archive = Archive::findorFail($this->delete_id);
        $archive->delete();

        $this->dispatchBrowserEvent('archiveDeleted');
    }

    public function render()
    {
        return view('livewire.delete-record', [
            'archives' => Archive::all()->where('user_id', $this->user_id),
        ]);
    }
}
