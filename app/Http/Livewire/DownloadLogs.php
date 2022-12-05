<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Exports\ActivityLogsExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DownloadLogs extends Component
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
    public $showBulkDeleteModal = false;

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
            $this->showViewModal = true;
        } else {
            return $this->alert('error', 'Please choose at least one download log.');
        }
    }

    public function exportToCsv()
    {
        $csvExported = Excel::download(new ActivityLogsExport((clone $this->activitiesQuery)
        ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected))->get()->pluck('id')), 'download_logs_' . date('Y-m-d') . '_' . now()->toTimeString() . '.csv');
        
        $this->showViewModal = false;
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
        
        $this->showViewModal = false;
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
        
        $this->showViewModal = false;
        $this->selectPage = false;
        $this->selectAll = false;
        $this->selected = [];

        $this->alert('success', 'Export PDF Successfully!');

        return $pdfExported;
    }

    public function beforeDeleteSelected() {
        if($this->selectPage || $this->selectAll || $this->selected) {
            $this->logTitle = "Delete Download Logs";
            $this->showBulkDeleteModal = true;
        } else {
            return $this->alert('error', 'Please choose at least one download log.');
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

    public function makeBlankDownloadLogs() {
        return DownloadLogs::make();
    }

    public function delete($log) {
        $this->deleteLog = Activity::find($log);

        $this->showDeleteModal = true;

        $this->logTitle = "Delete Download Log";
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
        ->whereNot(function ($query) {
            $query->where('event', 'login')
            ->orWhere('event', 'logout')
            ->orWhere('event', 'search')
            ->orWhere('event', 'bookmark')
            ->orWhere('event', 'update profile')
            ->orWhere('event', 'update password')
            ->orWhere('event', 'update thesis')
            ->orWhere('event', 'verify email')
            ->orWhere('event', 'reset password')
            ->orWhere('event', 'submit thesis');
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

        return view('livewire.download-logs', [
            'activities' => $this->activities,
            'department_list' => Department::all(),
        ]);
    }
}
