<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    
   public function index(){
        $posts = Post::orderBy('created_at', 'desc')
        ->limit(6)
        ->skip(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->get();
        return view('site.pages.home', compact(['posts']));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->limit(1)->first();
        return view('site.pages.single-post');
    }
}
