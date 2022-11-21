<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ActivityLogs extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'asc';

    public $logTitle;

    public $deleteLog;

    public $showResults = '5';

    // Modals
    public $showDeleteModal = false;

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function delete($log) {
        $this->deleteLog = Activity::find($log);

        $this->showDeleteModal = true;

        $this->logTitle = "Delete Activity Log";
    }

    public function deleteLog() {
        $this->deleteLog->delete();

        $this->showDeleteModal = false;

        $this->alert('success', $this->logTitle . ' ' . 'Successfully!');
    }

    public function render()
    {

        return view('livewire.activity-logs', [
            'activities' => Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
                    ->whereNot(function ($query) {
                        $query->where('event', 'search')
                            ->orWhere('event', 'download thesis');
                    })
                    ->where('student_id', 'like', '%'  . $this->search . '%')
                    ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.event', 'activity_log.properties', 'users.student_id')
                    ->orderBy($this->sortField, $this->sortDirection)->paginate($this->showResults),
        ]);
    }
}
