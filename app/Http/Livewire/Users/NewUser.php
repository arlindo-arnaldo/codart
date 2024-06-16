<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use app\Models\User;
use Livewire\WithFileUploads;
use PhpParser\Node\Expr\FuncCall;

class NewUser extends Component
{
    use WithFileUploads;
    public $username, $name, $email, $password, $type, $photo;

    protected $listeners  = [
        'resetForms'
    ];
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'username'=> 'required|unique:users,username|min:6|max:20',
        'type' => 'required|exists:types,id',
        'password' => 'required|min:8|max:20',
        
    ];


    public function generatePassword(){
        $default_password =  strtoupper(Random::generate(10));
        $this->password = $default_password;
    }
    public function resetForms(){
        $this->username = $this->name = $this->email = $this->password = $this->type = $this->photo = null;
        $this->resetErrorBag();
    }
    public function updatePhoto(){
        $this->validate([
            'photo' => 'image|max:2048' // 2 MB
        ]);
    }
    public function save(){
       $this->validate();

        $user = new User;
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->type = $this->type;
        $filename = 'IMG_'.strtotime(now()).rand(0,100).'.jpg';
        $user->photo = $filename;
        $user->about = "Olá eu sou o ".$this->name.", autor deste artigo";

        if (!$this->photo) {
            $user->photo = 'default.jpg';
        }else{
            $this->photo->storeAs('public/users', $filename);
        }
            if ($user->save()) {
                session()->flash('success', 'Usuário adicionado com sucesso');
                $this->resetForms();    
            }  
    }
    public function render()
    {
        return view('livewire.users.new-user');
    }
}
