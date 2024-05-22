<?php

namespace App\Http\Livewire\Users\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password, $new_password, $confirm_password;

    public function resetForm(){
        $this->current_password = $this->new_password = $this->confirm_password = null;
        $this->resetErrorBag();
    }
    public function changePassword(){
        $this->validate([
            'current_password' => ['required', function($attribute, $value, $fail){
                if (!Hash::check($value, User::find(auth()->id())->password)) {
                    return $fail(__('Senha incorreta'));
                }
            }],

            'new_password' => 'required|min:5|max:20',
            'confirm_password' => 'required|same:new_password'
        ]);

        $query = User::find(auth()->id())->update([
            'password' => Hash::make($this->new_password),
        ]);
        if ($query) {
            $this->resetForm();
            session()->flash('success', 'Senha alterada com sucesso!');
        }
        
    }
    public function render()
    {
        return view('livewire.users.profile.change-password');
    }
}
