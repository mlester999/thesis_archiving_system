<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Archive;

class TitleSearchBar extends Component
{

    public $query;
    public $titles;
    public $highlightIndex;

    public function mount() {
        $this->reset();
    }

    public function resetSearch() {
        $this->query = "";
        $this->titles = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight() {

        if($this->highlightIndex == count($this->titles) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight() {

        if($this->highlightIndex == 0) {
            $this->highlightIndex = count($this->titles) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function updatedQuery() {
        sleep(1);
        $this->titles = Archive::where('archive_status', 1)->where('title', 'LIKE', '%' . $this->query . '%')->get()->toArray(); 
    }


    public function render()
    {
        return view('livewire.title-search-bar');
    }
}
