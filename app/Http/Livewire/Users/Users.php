<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
class Users extends Component
{
    use WithPagination;
    public $per_page = 10;    

    protected $listeners = [
        'updateUserList' => '$refresh'
    ];
    
    public function deleteUser($id){
        $user = User::find($id);
        if ($user->delete()) {
            $this->resetPage();
            session()->flash('success', 'Usuário removido com sucesso');
        }
    }
    public function render()
    {
        $users = User::paginate($this->per_page);
        return view('livewire.users.users', compact(['users']));
    }
}
