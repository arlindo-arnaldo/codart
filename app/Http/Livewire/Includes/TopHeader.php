<?php

namespace App\Http\Livewire\Includes;

use Livewire\Component;

class TopHeader extends Component
{
    protected $listeners = [
        'updateTopHeader' => '$refresh'
    ];
    public function render()
    {
        $user = auth()->user();
        return view('livewire.includes.top-header', ['user' => $user]);
    }
}
