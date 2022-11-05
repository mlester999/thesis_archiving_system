<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Archive;
use App\Models\Department;

class TitleSearchBar extends Component
{

    public $query;
    public $titles;
    public $currentPage;
    // public $highlightIndex;

    public function mount($currentPage) {

        $this->currentPage = $currentPage;

        $this->resetSearch();
    }

    public function resetSearch() {
        $this->query = "";
        $this->titles = [];
        // $this->highlightIndex = 0;
    }

    // public function incrementHighlight() {

    //     if($this->highlightIndex == count($this->titles) - 1) {
    //         $this->highlightIndex = 0;
    //         return;
    //     }

    //     $this->highlightIndex++;
    // }

    // public function decrementHighlight() {

    //     if($this->highlightIndex == 0) {
    //         $this->highlightIndex = count($this->titles) - 1;
    //         return;
    //     }

    //     $this->highlightIndex--;
    // }

    public function updatedQuery() {
        sleep(1);

        if($this->currentPage == 'projects') {
            $this->titles = Archive::where('archive_status', 1)->where('title', 'LIKE', '%' . $this->query . '%')->orderBy('created_at', 'desc')->get()->toArray(); 
        } else {
            $deptData = Department::all()->where('dept_name', strtoupper($this->currentPage))->first();
    
            $this->titles = Archive::where('department_id', $deptData->id)->where('archive_status', 1)->where('title', 'LIKE', '%' . $this->query . '%')->orderBy('created_at', 'desc')->get()->toArray(); 
        }

    }


    public function render()
    {
        return view('livewire.title-search-bar');
    }
}
