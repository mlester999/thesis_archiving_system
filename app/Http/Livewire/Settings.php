<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\FrontPageSlider;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Settings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $sliderTitle;

    public $deleteSlider;

    public $viewSlider;

    public $showResults = '5';

    // Viewing Slider Info
    public $sliderId;
    public $title;
    public $imgUrl;
    public $createdAt;
    public $status;

    public $upload_image;
    
    // Modals
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showViewModal = false;
    
    public FrontPageSlider $editing;

    protected $rules = [
        'editing.title' => 'required|min:3',
        'editing.img_url' => 'nullable',
        'editing.status' => 'required',
    ];

    public function mount() {
        $this->editing = $this->makeBlankSlider();
    }

    public function closeModal() {
        $this->showEditModal = false;
    }

    public function create() {
        $this->resetErrorBag();

        $this->sliderId = '';

        if ($this->editing->getKey()) $this->editing = $this->makeBlankSlider();

        $this->showEditModal = true;

        $this->sliderTitle = "Add Slide";
    }

    public function view($slider) {
        $this->viewSlider = FrontPageSlider::find($slider);

        $this->sliderId = $this->viewSlider->id;

        $this->title = $this->viewSlider->title;

        $this->imgUrl = $this->viewSlider->img_url;

        $this->createdAt = $this->viewSlider->created_at;

        $this->status = $this->viewSlider->status;

        $this->showViewModal = true;

        $this->sliderTitle = "Slide Info";
    }

    public function makeBlankSlider() {
        return FrontPageSlider::make();
    }

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatedUploadImage() {
        // dd($this->upload_image);
    }

    public function edit(FrontPageSlider $slider) {

        $this->resetErrorBag();

        $this->sliderId = $slider->id;

        if($this->editing->isNot($slider)) $this->editing = $slider;

        $this->dispatchBrowserEvent('remove-images');

        $this->showEditModal = true;

        $this->sliderTitle = "Edit Slide";
    }

    public function save() {

        $this->validate();

        $this->validate([
            'upload_image' => 'required|image|mimes:jpeg,png,jpg|max:10000|dimensions:min_width=650,min_height=650',
        ]);

        // Save the current data to get the id
        $this->editing->save();

        $filename = $this->upload_image->storeAs('/', 'home-sliders-' . $this->editing->id . '.' . $this->upload_image->getClientOriginalExtension(), 'home-sliders');
        
        $this->editing->img_url = $filename;

        // save the data again with image URL
        $this->editing->save();

        $this->showEditModal = false;

        $this->upload_image = null;

        $this->dispatchBrowserEvent('remove-images');

        $this->alert('success', $this->sliderTitle . ' ' . 'Successfully!');
    }

    public function delete($slider) {
        $this->deleteSlider = FrontPageSlider::find($slider);

        $this->showDeleteModal = true;

        $this->sliderTitle = "Delete Slide";
    }

    public function deleteSlider() {
        $this->deleteSlider->delete();

        Storage::disk('home-sliders')->delete($this->deleteSlider->img_url);

        $this->editing = $this->makeBlankSlider();

        $this->showDeleteModal = false;

        $this->alert('success', $this->sliderTitle . ' ' . 'Successfully!');
    }


    public function render()
    {
        return view('livewire.settings', [
            'sliders' => FrontPageSlider::where('title', 'like', '%'  . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortDirection)->paginate($this->showResults),
        ]);
    }
}
