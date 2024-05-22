<?php

namespace App\Http\Livewire\Users\Profile;

use Livewire\Component;
use App\Models\User;

class PersonalDetails extends Component
{
    public $name, $username, $email;

    

    public function mount(){
        $user = User::find(auth()->id());
        if ($user) {
            $this->name = $user->name;
            $this->username = $user->username;
            $this->email = $user->email;
        }

    }

    public function UpdatePersonalDetails(){
        $this->validate([
            'name'      => 'required|string',
            'username'  => 'required|unique:users,username,'.auth()->id(),
            'email'     => 'required|email|unique:users,email,'.auth()->id(),
        ],[
            'name.required' => 'Este campo é obrigatório',
            'username.required' => 'Este campo é obrigatório',
            'email.required' => 'Este campo é obrigatório',
            'username.unique' => 'Este nome de usuário já existe',
            'email.unique' => 'Este email já existe'
        ]);

        $user = User::find(auth()->id());
        
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;

        if($user->update()){
            $this->emit('updateTopHeader');
            $this->emit('updateProfile');
            $this->emit('updateUserList');
            session()->flash('success', 'Perfil actualizado com sucesso');
        }
        
    }
    public function render()
    {
        return view('livewire.users.profile.personal-details');
    }
}

