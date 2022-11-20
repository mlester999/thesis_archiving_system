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

    public $userTitle;

    public $deleteUser;

    public $viewUser;

    public $showResults = '5';

    // Viewing User Info
    public $userId;
    public $name;
    public $username;
    public $email;
    public $email_verified_at;
    public $createdAt;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    public $activityLogs;
    public $searches;
    public $searchCount;
    public $sortedArr;
    public $sortedArrKeys;

    // Editing Table
    public Activity $editing;

    public function mount() {
        $this->editing = $this->makeBlankUser();

        $this->searches = [];
    }

    public function view() {

        $this->activityLogs = Activity::where('event', 'search')->get();
        
        $this->searches = $this->activityLogs->unique('description')->take(5);

        $this->searchCount = array_count_values($this->activityLogs->pluck('description')->toArray());

        $this->sortedArr = collect($this->searchCount)->sortKeys()->sortDesc();

        $this->sortedArrKeys = $this->sortedArr->keys();

        $this->showViewModal = true;

        $this->userTitle = "Most Searched Thesis";
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function makeBlankUser() {
        return Activity::make();
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

        return view('livewire.report-logs', [
            'activities' => Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
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
