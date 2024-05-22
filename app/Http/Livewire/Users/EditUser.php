<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EditUser extends Component
{
    public $user_id, $username, $name, $email, $type;

    protected $listeners  = [
        'resetForms'
    ];
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'username'=> 'required|unique:users,username|min:6|max:20',
        'type' => 'required|exists:types,id',
        'password' => 'required|min:8|max:20'
    ];

    public function mount(){
        $this->user_id = session('id');
        $user = User::find($this->user_id);
        $this->username = $user->username;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->type = $user->type;
    }
    public function save(){
        $user = User::find($this->user_id);
        
        $user->username = $this->username;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->type = $this->type;
        if($user->update()){
            session()->flash('success', 'Usuário editado com sucesso');
            $this->emit('updateTopHeader');
        }
    }
    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
