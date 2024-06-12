<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    
   public function index(){
       /* $posts = Post::orderBy('created_at', 'desc')
        ->limit(6)
        ->skip(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->get();*/

        $latest_post = Post::orderBy('created_at', 'desc')
        ->limit(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->get();

        $latest_post = json_encode($latest_post);
        $latest_post = json_decode($latest_post,1);
        
        return view('site.pages.home', compact(['latest_post']));
    }
}
