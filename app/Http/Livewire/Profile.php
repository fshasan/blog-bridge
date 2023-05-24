<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $email;
    public $success = false;

    public User $user;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.profile');
    }

    public function updateProfile()
    {
        $this->validate();

        Auth::user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->success = true;

        session()->flash('message', 'Profile successfully updated.');
    }
}
