<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }
    public function render()
    {
        return view('livewire.profile');
    }

    public function updateProfile()
    {
        Auth::user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}
