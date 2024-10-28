<?php

namespace App\Livewire\Dashboard\Models\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateModal extends Component
{
    use PasswordValidationRules;

    public $action = 'create-user';
    public $user;

    public $image;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function showModal()
    {
        $this->dispatch('init-filepond', [
            'componentId' => $this->__id,
            'id' => $this->action . '-image',
            'name' => 'image',
            'model' => 'defer',
            'urls' => [],
        ]);
        $this->dispatch('showCreateUserModal');
    }

    public function submit()
    {
        $this->validate([
            'image' => 'nullable|string',
            'name' => 'required|string|max:155',
            'email' => 'required|string|email|max:155|unique:users',
            'password' => $this->passwordRules(),
        ]);

        try {

            DB::beginTransaction();

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            if ($this->image) {
                $file = $user->uploadFile($this->image, 'user-image', 'users/' . $user->id, 'main-image-' . now()->timestamp);
                $user->update([
                    'profile_photo_path' => $file->path,
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }

        $this->dispatch('successEventListener', [
            'message' => 'User Added Successfully',
        ]);
        $this->dispatch('hideCreateUserModal');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.dashboard.models.user.create-modal');
    }
}
