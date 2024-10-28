<?php

namespace App\Livewire\Dashboard\Models\Project;

use App\Enums\Profile;
use App\Enums\ProfileType;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateModal extends Component
{
    public $action = 'create-project';

    public $project;

    public $type;
    public $profile;
    public $width_top_inside;
    public $width_down_inside;
    public $height_inside;
    public $height_outside;
    public $note;
    public $name;

    public $profiles = [];
    public $profileTypes = [];

    public function mount()
    {
        $this->profiles = Profile::asSelectArray();
        $this->profileTypes = ProfileType::asSelectArray();
    }

    public function showModal()
    {
        $this->dispatch('showCreateProjectModal');
    }

    public function updatedProfile($value)
    {
        $this->dispatch('profile-updated', $value)->self();
    }

    public function submit()
    {
        $this->validate([
            'name' => 'string|required',
            'type' => 'required',
            'width_top_inside' => 'required|numeric',
            'width_down_inside' => 'required|numeric',
            'height_inside' => 'required|numeric',
            'height_outside' => 'required|numeric',
            'profile' => 'required',
            'note' => 'nullable|max:500',
        ]);

        try {
            DB::beginTransaction();

            $this->project = Project::create([
                'name' => $this->name,
                'profile_type' => $this->type,
                'profile' => $this->profile,
                'width_top_inside' => $this->width_top_inside,
                'width_down_inside' => $this->width_down_inside,
                'height_inside' => $this->height_inside,
                'height_outside' => $this->height_outside,
                'note' => $this->note,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }

        $this->dispatch('successEventListener', [
            'message' => 'Project Added Successfully',
        ]);
        $this->dispatch('hideCreateProjectModal');
        $this->reset();
        $this->updatedProfile($this->profile);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.dashboard.models.project.create-modal');
    }
}
