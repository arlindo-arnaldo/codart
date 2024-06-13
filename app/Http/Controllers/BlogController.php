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

        $latest_post = Post::orderBy('created_at', 'desc')
        ->limit(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->first();
        $latest_post->body = Str::ucfirst(Str::words(strip_tags($latest_post->body), 35, '...'));

        $recommended_posts = Post::with('author')
            ->with('subcategory')
            ->with('thumbnail')
            ->limit(4)
            ->inRandomOrder()
            ->get();
        return view('site.pages.home', compact(['latest_post', 'posts', 'recommended_posts']));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->limit(1)->first();
        dd($post);
    }
}
