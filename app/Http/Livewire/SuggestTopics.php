<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Archive;
use Spatie\Activitylog\Models\Activity;

class SuggestTopics extends Component
{
    public $showViewModal = false;
    public $logTitle;

    public $activityLogs;
    public $searches;
    public $searchCount;
    public $sortedArr;
    public $sortedArrKeys;
    public $topicsAvailability;

    public function mount() {
        $this->searches = [];
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
        return view('livewire.suggest-topics');
    }
}
