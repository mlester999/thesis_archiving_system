<?php

namespace App\Http\Livewire;

use App\Models\Archive;
use Livewire\Component;

class StudentProjects extends Component
{
    public function render()
    {
        return view('livewire.student-projects', [
            'archiveData' => Archive::where('archive_status', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate(5)
        ]);
    }
}
