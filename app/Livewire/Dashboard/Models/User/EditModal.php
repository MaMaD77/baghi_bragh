<?php

namespace App\Livewire\Dashboard\Models\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditModal extends Component
{
    use PasswordValidationRules;

    public $action = 'edit-user';
    public $user;

    public $image;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function showModal($id)
    {
        $this->user = User::with('image')->findOrFail($id);

        $this->image = $this->user->image ? $this->user->image_url : null;
        $this->name = $this->user->name;
        $this->email = $this->user->email;

        $this->dispatch('showEditUserModal');
    }

    public function submit()
    {
        $this->validate([
            'image' => 'nullable|string',
            'name' => 'required|string|max:155',
            'email' => 'required|string|email|max:155|unique:users,name,' . $this->user->id,
        ]);

        if (!empty($this->password)) {
            $this->validate([
                'password' => $this->passwordRules(),
            ]);
        }

        try {
            DB::beginTransaction();

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);


            if (!empty($this->password)) {
                $this->user->update([
                    'password' => Hash::make($this->password),
                ]);
            }

            if ($this->image && $this->image != $this->user->image_url) {
                if ($this->user->image) {
                    Storage::delete($this->user->image->path);
                    $this->user->image()->delete();
                }

                $file = $this->user->uploadFile($this->image, 'user-image', 'users/' . $this->user->id, 'main-image-' . now()->timestamp);
                $this->user->update([
                    'profile_photo_path' => $file->path,
                ]);
            } elseif (!$this->image && $this->user->image()->exists()) {
                Storage::delete($this->user->image->path);
                $this->user->image()->delete();
                $this->user->update([
                    'profile_photo_path' => null,
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }

        $this->dispatch('successEventListener', [
            'message' => 'User Updated Successfully',
        ]);
        $this->dispatch('hideEditUserModal');
    }

    public function render()
    {
        return view('livewire.dashboard.models.user.edit-modal');
    }
}
