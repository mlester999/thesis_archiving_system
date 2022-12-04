<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use App\Models\ResearchAgenda;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResearchAgendas extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $agendaTitle;

    public $deleteAgenda;

    public $viewAgenda;

    public $showResults = '5';

    // Viewing User Info
    public $agendaId;
    public $agenda_name;
    public $agenda_description;
    public $agenda_status;
    public $createdAt;

    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;

    // Editing Table
    public ResearchAgenda $editing;

    protected $rules = [
        'editing.agenda_name' => 'required',
        'editing.agenda_description' => 'required',
        'editing.agenda_status' => 'required',
    ];

    public function mount() {
        $this->editing = $this->makeBlankAgenda();
    }

    public function closeModal() {

        $this->showEditModal = false;

    }

    public function create() {

        $this->resetErrorBag();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankAgenda();

        $this->showEditModal = true;

        $this->agendaTitle = "Add Research Agenda";
    }

    public function view($agenda) {
        $this->viewAgenda = ResearchAgenda::find($agenda);

        $this->agendaId = $this->viewAgenda->id;

        $this->agenda_name = $this->viewAgenda->agenda_name;

        $this->agenda_description = $this->viewAgenda->agenda_description;

        $this->agenda_status = $this->viewAgenda->agenda_status;

        $this->createdAt = $this->viewAgenda->created_at;

        $this->showViewModal = true;

        $this->agendaTitle = "Research Agenda Info";
    }

    public function makeBlankAgenda() {
        return ResearchAgenda::make();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(ResearchAgenda $agenda) {

        $this->resetErrorBag();

        if($this->editing->isNot($agenda)) $this->editing = $agenda;

        $this->showEditModal = true;

        $this->agendaTitle = "Edit Research Agenda";
    }

    public function save() {
        $this->validate();

        if(count(ResearchAgenda::where('id', $this->editing->id)->where('agenda_name', $this->editing->agenda_name)
        ->where('agenda_description', $this->editing->agenda_description)->get()) == 1 || 
        (count(ResearchAgenda::where('id', $this->editing->id)->where('agenda_name', $this->editing->agenda_name)
        ->get()) == 1 && count(ResearchAgenda::where('agenda_description', $this->editing->agenda_description)
        ->get()) == 0) ||
        (count(ResearchAgenda::where('id', $this->editing->id)->where('agenda_description', $this->editing->agenda_description)
        ->get()) == 1 && count(ResearchAgenda::where('agenda_name', $this->editing->agenda_name)
        ->get()) == 0) ||
        (count(ResearchAgenda::where('agenda_description', $this->editing->agenda_description)
        ->get()) == 0 && count(ResearchAgenda::where('agenda_name', $this->editing->agenda_name)->get()) == 0)) {

            $this->editing->save();

            $this->showEditModal = false;

            $this->alert('success', $this->agendaTitle . ' ' . 'Successfully!');

        } else {
            $this->showEditModal = false;

            $this->alert('error', 'This data is already existing!');

            $this->editing = $this->makeBlankAgenda();
        }
    }

    public function delete($agenda) {
        $this->deleteAgenda = ResearchAgenda::find($agenda);

        $this->showDeleteModal = true;

        $this->agendaTitle = "Delete Research Agenda";
    }

    public function deleteAgenda() {
        $this->deleteAgenda->delete();

        $this->editing = $this->makeBlankAgenda();

        $this->showDeleteModal = false;

        $this->alert('success', $this->agendaTitle . ' ' . 'Successfully!');
    }


    public function render()
    {

        return view('livewire.research-agendas', [
            'agendas' => ResearchAgenda::where('id', 'like', '%'  . $this->search . '%')
            ->orWhere('agenda_name', 'like', '%'  . $this->search . '%')
            ->orWhere('agenda_status', 'like', '%'  . $this->search . '%')
            ->orWhere('agenda_description', 'like', '%'  . $this->search . '%')
            ->select('research_agendas.id', 'research_agendas.agenda_name', 'research_agendas.agenda_status', 'research_agendas.agenda_description', 'research_agendas.created_at')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->showResults),
        ]);
    }
}
