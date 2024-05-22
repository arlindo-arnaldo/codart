<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $photo;
    protected $listeners = [
        'updateProfile' => '$refresh'
    ];
    public function render()
    {
        $user = auth()->user();
        return view('livewire.users.profile', ['user' => $user]);
    }
}
