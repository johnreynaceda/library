<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $photo;
    public $edit_modal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->photo = $user->photo; // This is a string, not an UploadedFile
    }

    public function updateProfile()
    {
        $this->validate();

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->photo instanceof UploadedFile) {

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }


            $path = $this->photo->store('profile_photos', 'public');
            $user->photo = $path;
        }


        try {
            $user->save();
        } catch (\Exception $e) {

            session()->flash('error', 'Failed to update profile: ' . $e->getMessage());
            return;
        }

        session()->flash('message', 'Profile updated successfully!');
        $this->edit_modal = false;
    }


    public function render()
    {
        return view('livewire.user.profile', [
            'user' => Auth::user(),
        ]);
    }
}
