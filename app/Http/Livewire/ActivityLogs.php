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

    public $logTitle;

    public $deleteLog;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $selectPage = false;

    public $selectAll = false;

    public $showResults = '5';

    public $selected = [];

    // Modals
    public $showDeleteModal = false;

    public function mount() {
        $this->logTitle = "Delete Activity Logs";
    }

    public function updatedSelected() {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value) {
        $this->selected = $value
            ? $this->activities->pluck('id')->map(fn($id) => (string) $id)
            : [];
    }

    public function selectAll() {
        $this->selectAll = true;
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function exportSelected()
    {
        if(!$this->selectPage || !$this->selectAll || !$this->selected) {
            return $this->alert('error', 'Please choose at least one activity log.');
        }

        return response()->streamDownload(function () {
            echo (clone $this->activitiesQuery)
                ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))
                ->toCsv();
        }, 'activity-logs.csv');
    }

    public function beforeDeleteSelected() {
        if($this->selectPage || $this->selectAll || $this->selected) {
            $this->showDeleteModal = true;
        } else {
            return $this->alert('error', 'Please choose at least one activity log.');
        }
    }

    public function deleteSelected()
    {
        (clone $this->activitiesQuery)
            ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))
            ->delete();

        $this->showDeleteModal = false;

        $this->selectPage = false;

        $this->selectAll = false;

        $this->selected = false;

        $this->alert('success', $this->logTitle . ' ' . 'Successfully!');
    }

    public function makeBlankActivityLogs() {
        return ActivityLogs::make();
    }

    public function delete($log) {
        $this->deleteLog = Activity::find($log);

        $this->logTitle = "Delete Activity Log";
    }

    public function deleteLog() {
        $this->deleteLog->delete();

        $this->showDeleteModal = false;

        $this->alert('success', $this->logTitle . ' ' . 'Successfully!');
    }

    public function getActivitiesQueryProperty() {
        return Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
        ->whereNot(function ($query) {
            $query->where('event', 'search')
                ->orWhere('event', 'download thesis');
        })
        ->where('student_id', 'like', '%'  . $this->search . '%')
        ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.event', 'activity_log.properties', 'users.student_id')
        ->orderBy($this->sortField, $this->sortDirection);
    }

    public function getActivitiesProperty() {
        return $this->activitiesQuery->paginate($this->showResults);
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->activities->pluck('id')->map(fn($id) => (string) $id);
        }

        return view('livewire.activity-logs', [
            'activities' => $this->activities,
        ]);
    }
}
