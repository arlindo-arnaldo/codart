<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function logout(){
        auth()->logout();
        session()->flash('info', 'Sessão terminada');
        return redirect()->route('admin.login');
    }

    
    public function editUser($id){
        session()->flash('id', $id);
        return view('admin.pages.users.edit-user');
    }
    public function deleteUser($id){
        $user = User::find($id);
        return view('admin.pages.users.delete-user', compact(['user']));
    }
    public function ConfirmDeleteUser($id, Request $request){
        
        $posts = Post::where('author_id', $id)->get();

        foreach ($posts as $post) {
            $post->author_id =  $request->user;
            $post->save();
        }

        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.home');
        }
    }
    
}
