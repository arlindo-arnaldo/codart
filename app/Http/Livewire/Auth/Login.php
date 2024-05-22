<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use Symfony\Component\HttpFoundation\Session\SessionBagProxy;

class Login extends Component
{
    public $email, $password, $remember;
  

    public function loginHandler(){
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ],[
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'Este email não é válido',
            'email.exists' => 'Este email não está cadastrado o sistema'
        ]);

        $creds = array('email'=> $this->email, 'password'=> $this->password);
        if (Auth::attempt($creds, filled($this->remember))) {
            $chek_user = User::where('email', $this->email)->first();
            if ($chek_user->blocked == 1) {
                Auth::logout();
                return redirect()->route('admin.login')->with('fail', 'Esta conta encontra-se bloqueada');
            }else { 
                return redirect()->route('admin.home');
            }
            
        }else {
            session()->flash('fail', 'Email ou senha incorrectos');
        }

    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
