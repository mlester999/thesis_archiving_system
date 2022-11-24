<?php

namespace App\Http\Livewire;

use App\Models\Archive;
use Livewire\Component;
use App\Models\Department;
use App\Models\ResearchAgenda;
use Spatie\Activitylog\Models\Activity;

class StudentProjects extends Component
{
    // For Title Search Bar
    public $query;
    public $titles;
    public $currentPage;

    // For Top Search Modal
    public $showViewModal = false;
    public $logTitle;
    public $activityLogs;
    public $searches;
    public $searchCount;
    public $sortedArr;
    public $sortedArrKeys;
    public $topicsAvailability;

    public function mount($currentPage) {

        $this->searches = [];

        $this->currentPage = $currentPage;

        $this->resetSearch();
    }

    public function resetSearch() {
        $this->query = "";
        $this->titles = [];
    }

    public function updatedQuery() {

        if($this->currentPage == 'projects') {
            $this->titles = Archive::where('archive_status', 1)->where('title', 'LIKE', '%' . $this->query . '%')->orderBy('created_at', 'desc')->limit(5)->get()->toArray(); 
        } elseif($this->currentPage == 'bookmarks') {
            $this->titles = Archive::whereHasBookmark(
                auth()->user()
            )->where('title', 'LIKE', '%' . $this->query . '%')->orderBy('created_at', 'desc')->limit(5)->get()->toArray(); 
        }
        else {
            $deptData = Department::all()->where('dept_name', strtoupper($this->currentPage))->first();
    
            $this->titles = Archive::where('department_id', $deptData->id)->where('archive_status', 1)->where('title', 'LIKE', '%' . $this->query . '%')->orderBy('created_at', 'desc')->limit(5)->get()->toArray(); 
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
        $this->topicsAvailability = collect($availableTopics);

        $this->logTitle = "Suggested Topics";

        $this->showViewModal = true;
    }

    public function render()
    {
        return view('livewire.student-projects', [
            'archiveData' => Archive::where('archive_status', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate(5),
            'agendaData' => ResearchAgenda::all()
        ]);
    }
}
