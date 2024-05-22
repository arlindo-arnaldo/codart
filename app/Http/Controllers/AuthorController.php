<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function logout(){
        auth()->logout();
        session()->flash('info', 'Sessão terminada');
        return redirect()->route('admin.login');
    }

    public function changeProfilePicture(){
        
    }
    public function editUser($id){
        session()->flash('id', $id);
        return view('admin.pages.users.edit-user');
    }
    
}
