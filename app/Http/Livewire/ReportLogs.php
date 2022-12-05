<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\Archive;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Exports\ActivityLogsExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ReportLogs extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $logTitle;

    public $deleteLog;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $department = '';

    public $selectPage = false;

    public $selectAll = false;

    public $showResults = '5';

    public $selected = [];

    // Modals
    public $showDeleteModal = false;
    public $showViewModal = false;
    public $showBulkViewModal = false;
    public $showBulkDeleteModal = false;

    public $activityLogs;
    public $searches;
    public $searchCount;
    public $sortedArr;
    public $sortedArrKeys;
    public $topicsAvailability;
    
    public $showTopics;
    public $activityTopics;
    public $topics;

    public function mount() {
        $this->searches = [];

        $this->topicsAvailability = [];

        $this->activityTopics = Activity::where('event', 'search')->get();

        $this->topics = $this->activityTopics->unique('description')->pluck('description')->toArray();
    }

    public function view() {

        $this->activityLogs = Activity::where('event', 'search')->get();
        
        $this->searches = $this->activityLogs->unique('description')->take(5);

        $this->searchCount = array_count_values($this->activityLogs->pluck('description')->toArray());

        $this->sortedArr = collect($this->searchCount)->sortKeys()->sortDesc();

        $this->sortedArrKeys = $this->sortedArr->keys();

        foreach($this->sortedArrKeys as $key => $sorted) {
            $allTopics[] = $sorted;
            $availableArchive[] = Archive::where('archive_status', '1')->where('title', 'like', '%'  . $allTopics[$key] . '%')->pluck('title')->toArray();

            if($availableArchive[$key]) {
                $availableTopics[] = $allTopics[$key];
            }
        }

        if (!empty($availableTopics)) {
            $this->topicsAvailability = collect($availableTopics)->take(5);
        }

        $this->showViewModal = true;

        $this->logTitle = "Most Searched Thesis";
    }

    public function sortDepartment($dept) {
        $this->department = $dept;
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

    public function beforeExportSelected() {
        if($this->selectPage || $this->selectAll || $this->selected) {
            $this->logTitle = "Export Download Logs";
            $this->showBulkViewModal = true;
        } else {
            return $this->alert('error', 'Please choose at least one report log.');
        }
    }

    public function exportToCsv()
    {
        $csvExported = Excel::download(new ActivityLogsExport((clone $this->activitiesQuery)
        ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))->get()->pluck('id')), 'download_logs_' . date('Y-m-d') . '_' . now()->toTimeString() . '.csv');
        
        $this->showBulkViewModal = false;
        $this->selectPage = false;
        $this->selectAll = false;
        $this->selected = [];

        $this->alert('success', 'Export CSV Successfully!');

        return $csvExported;
    }

    public function exportToXls()
    {
        $xlsxExported = Excel::download(new ActivityLogsExport((clone $this->activitiesQuery)
        ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))->get()->pluck('id')), 'download_logs_' . date('Y-m-d') . '_' . now()->toTimeString() . '.xlsx');
        
        $this->showBulkViewModal = false;
        $this->selectPage = false;
        $this->selectAll = false;
        $this->selected = [];

        $this->alert('success', 'Export XLSX Successfully!');

        return $xlsxExported;
    }

    public function exportToPdf()
    {
        
        $pdfExported = Excel::download(new ActivityLogsExport((clone $this->activitiesQuery)
        ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))->get()->pluck('id')), 'download_logs_' . date('Y-m-d') . '_' . now()->toTimeString() . '.pdf');
        
        $this->showBulkViewModal = false;
        $this->selectPage = false;
        $this->selectAll = false;
        $this->selected = [];

        $this->alert('success', 'Export PDF Successfully!');

        return $pdfExported;
    }

    public function beforeDeleteSelected() {
        if($this->selectPage || $this->selectAll || $this->selected) {
            $this->logTitle = "Delete Report Logs";
            $this->showBulkDeleteModal = true;
        } else {
            return $this->alert('error', 'Please choose at least one report log.');
        }
    }

    public function deleteSelected()
    {
        (clone $this->activitiesQuery)
            ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))
            ->delete();

        $this->showBulkDeleteModal = false;

        $this->selectPage = false;

        $this->selectAll = false;

        $this->selected = [];

        $this->alert('success', $this->logTitle . ' ' . 'Successfully!');
    }

    public function makeBlankReportLogs() {
        return ReportLogs::make();
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

        $this->selectPage = false;

        $this->selectAll = false;

        $this->selected = [];
    }

    public function getActivitiesQueryProperty() {

        return Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
        ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
        ->when($this->showTopics, function($query) {
            $query->when($this->showTopics == 'Available Topics', function ($available) {
                foreach($this->topics as $key => $topic) {
                    $allTopics[] = $topic;
                    $availableArchive[] = Archive::where('archive_status', '1')->where('title', 'like', '%'  . $allTopics[$key] . '%')->pluck('title')->toArray();

                    if($availableArchive[$key]) {
                        $availableTopics[] = $allTopics[$key];
                    }
                }
                if(!empty($availableTopics)) {
                    $available->whereIn('description', $availableTopics);
                }
            })
            ->when($this->showTopics == 'Not Available Topics', function ($notAvailable) {
                foreach($this->topics as $key => $topic) {
                    $allTopics[] = $topic;
                    $availableArchive[] = Archive::where('archive_status', '1')->where('title', 'like', '%'  . $allTopics[$key] . '%')->pluck('title')->toArray();

                    if(!$availableArchive[$key]) {
                        $notAvailableTopics[] = $allTopics[$key];
                    }
                }
                if(!empty($notAvailableTopics)) {
                $notAvailable->whereIn('description', $notAvailableTopics);
                }
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
            ->orWhere('event', 'reset password')
            ->orWhere('event', 'download thesis');
        })
        ->where('dept_name', 'like', '%'  . $this->department . '%')
        ->where('student_id', 'like', '%'  . $this->search . '%')
        ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.event', 'activity_log.properties', 'users.student_id', 'departments.dept_name')
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

        return view('livewire.report-logs', [
            'activities' => $this->activities,
            'department_list' => Department::all(),
        ]);
    }
}
