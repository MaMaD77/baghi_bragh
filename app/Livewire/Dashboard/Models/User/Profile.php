<?php

namespace App\Livewire\Dashboard\Models\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    use PasswordValidationRules;

    public $user;

    public $name;
    public $email;
    public $photo;

    public $current_password;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id());

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->photo = $this->user->profile_photo_url;
    }

    public function updateProfileInformation()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|string|max:155|unique:users,email,' . $this->user->id,
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->dispatch('successEventListener', [
            'message' => 'Profile Info Updated Successfully',
        ]);
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => $this->passwordRules(),
        ]);

        $this->user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->dispatch('successEventListener', [
            'message' => 'Profile Password Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.models.user.profile');
    }
}
