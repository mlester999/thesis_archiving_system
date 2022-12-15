<?php

namespace App\Http\Livewire;

use App\Models\Archive;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Models\ResearchAgenda;
use Spatie\Activitylog\Models\Activity;

class StudentProjects extends Component
{
    use WithPagination;
    
    // For Title Search Bar
    public $search;

    public $sortField = 'id';
    public $sortDirection = 'desc';

    public $titles;
    public $currentPage;
    public $currentSearch;

    // For Top Search Modal
    public $showViewModal = false;
    public $logTitle;
    public $activityLogs;
    public $searches;
    public $searchCount;
    public $sortedArr;
    public $sortedArrKeys;
    public $topicsAvailability;

    // Advanced Search
    public $filters = [
        'year' => '',
        'research_agenda' => null,
    ];

    public function mount($currentPage, $currentSearch) {

        $this->searches = [];

        $this->topicsAvailability = [];

        $this->currentPage = $currentPage;

        $this->currentSearch = $currentSearch;

        $this->resetSearch();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function resetFilters() {
        $this->reset('filters');
    }

    public function resetSearch() {
        $this->search = "";
        $this->titles = [];
    }

    public function updatedSearch() {

        if($this->currentPage == 'projects') {
            $this->titles = Archive::where('archive_status', 1)->where('title', 'LIKE', '%' . $this->search . '%')->orderBy('created_at', 'desc')->limit(5)->get()->toArray(); 
        } elseif($this->currentPage == 'bookmarks') {
            $this->titles = Archive::whereHasBookmark(
                auth()->user()
            )->where('title', 'LIKE', '%' . $this->search . '%')->orderBy('created_at', 'desc')->limit(5)->get()->toArray(); 
        }
        else {
            $deptData = Department::all()->where('dept_name', strtoupper($this->currentPage))->first();
    
            $this->titles = Archive::where('department_id', $deptData->id)->where('archive_status', 1)->where('title', 'LIKE', '%' . $this->search . '%')->orderBy('created_at', 'desc')->limit(5)->get()->toArray(); 
        }
    }

    public function viewSuggestedTopics() {

        $this->activityLogs = Activity::where('event', 'search')->get();
        
        $this->searches = $this->activityLogs->unique('description')->take(5);

        $this->searchCount = array_count_values($this->activityLogs->pluck('description')->toArray());

        $this->sortedArr = collect($this->searchCount)->sortKeys()->sortDesc();

        $this->sortedArrKeys = $this->sortedArr->keys();

        foreach($this->sortedArrKeys as $key => $sorted) {
            $allTopics[] = $sorted;
            $availableArchive[] = Archive::where('archive_status', '1')->where('title', 'like', '%'  . $allTopics[$key] . '%')->pluck('title')->toArray();

            if(!$availableArchive[$key]) {
                $availableTopics[] = $allTopics[$key];
            }
        }

        if(!empty($availableTopics)) {
        $this->topicsAvailability = collect($availableTopics)->take(5);
        }

        $this->logTitle = "Suggested Topics";

        $this->showViewModal = true;
    }

    public function render()
    {
        return view('livewire.student-projects', [
            'archiveData' => Archive::query()
                        ->join('research_agendas', 'archives.research_agenda_id', '=', 'research_agendas.id')
                        ->join('users', 'archives.user_id', '=', 'users.id')
                        ->when($this->filters['year'], function($query, $year) {
                            $query->where('year', $year);
                        })
                        ->when($this->filters['research_agenda'], function($query, $research_agenda) {
                            $query->where('agenda_name', $research_agenda);
                        })
                        ->where('archive_status', 1)
                        ->where('title', 'LIKE', '%' . $this->currentSearch . '%')
                        ->orWhere('abstract', 'LIKE', '%' . $this->currentSearch . '%')
                        ->orWhere('first_name', 'LIKE', '%' . $this->currentSearch . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $this->currentSearch . '%')
                        ->select('archives.id', 'archives.archive_code', 'archives.title', 'archives.year', 'archives.abstract', 'archives.members', 'archives.document_path', 'archives.document_name', 'archives.archive_status', 'archives.department_id', 'archives.curriculum_id', 'archives.research_agenda_id', 'archives.user_id', 'archives.created_at', 'research_agendas.agenda_name', 'research_agendas.agenda_description', 'research_agendas.agenda_status')
                        ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate(5),
            'agendaData' => ResearchAgenda::all()
        ]);
    }
}
