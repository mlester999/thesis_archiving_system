<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ReportLogs extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $logTitle;

    public $deleteLog;

    public $viewLog;

    public $showResults = '5';

    // Modals
    public $showDeleteModal = false;
    public $showViewModal = false;

    public $activityLogs;
    public $searches;
    public $searchCount;
    public $sortedArr;
    public $sortedArrKeys;
    
    public $showTopics;

    public function mount() {
        $this->searches = [];
    }

    public function view() {

        $this->activityLogs = Activity::where('event', 'search')->get();
        
        $this->searches = $this->activityLogs->unique('description')->take(5);

        $this->searchCount = array_count_values($this->activityLogs->pluck('description')->toArray());

        $this->sortedArr = collect($this->searchCount)->sortKeys()->sortDesc();

        $this->sortedArrKeys = $this->sortedArr->keys();

        $this->showViewModal = true;

        $this->logTitle = "Most Searched Thesis";
    }

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

        $this->logTitle = "Delete Report Log";
    }

    public function deleteLog() {
        $this->deleteLog->delete();

        $this->showDeleteModal = false;

        $this->alert('success', $this->logTitle . ' ' . 'Successfully!');
    }


    public function render()
    {

        return view('livewire.report-logs', [
            'activities' => Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
                    ->when($this->showTopics, function($query) {
                        $query->when($this->showTopics == 'Avail
                        -able Topics', function ($available) {
                            $available->where('event', 'login');
                        })
                        ->when($this->showTopics == 'Not Available Topics', function ($notAvailable) {
                            $notAvailable->where('event', 'search');
                        });
                    })
                    ->whereNot(function ($query) {
                        $query->where('event', 'login')
                        ->orWhere('event', 'logout')
                        ->orWhere('event', 'bookmark')
                        ->orWhere('event', 'update profile')
                        ->orWhere('event', 'update password')
                        ->orWhere('event', 'update thesis')
                        ->orWhere('event', 'verify email')
                        ->orWhere('event', 'submit thesis')
                        ->orWhere('event', 'download thesis');
                    })
                    ->where('student_id', 'like', '%'  . $this->search . '%')
                    ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.event', 'activity_log.properties', 'users.student_id')
                    ->orderBy($this->sortField, $this->sortDirection)->paginate($this->showResults),
        ]);
    }
}
