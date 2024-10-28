<?php

namespace App\Livewire\Dashboard\Models\Project;

use App\Enums\Profile;
use App\Enums\ProfileType;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditModal extends Component
{
    public $action = 'edit-project';

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

    public function showModal($id)
    {
        $this->project = Project::findOrFail($id);

        $this->name = $this->project->name;
        $this->type = $this->project->profile_type->value;
        $this->profile = $this->project->profile->value;
        $this->width_top_inside = $this->project->width_top_inside;
        $this->width_down_inside = $this->project->width_down_inside;
        $this->height_inside = $this->project->height_inside;
        $this->height_outside = $this->project->height_outside;
        $this->note = $this->project->note;

        $this->updatedProfile($this->profile);

        $this->dispatch('showEditProjectModal');
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

            $this->project->update([
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
            'message' => 'Project Updated Successfully',
        ]);
        $this->dispatch('hideEditProjectModal');
    }

    public function render()
    {
        return view('livewire.dashboard.models.project.edit-modal');
    }
}
