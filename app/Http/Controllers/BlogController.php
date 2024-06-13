<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $post;
    
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        $posts = $this->post->orderBy('created_at', 'desc')
            ->limit(6)
            ->skip(1)
            ->with('category')
            ->with('subcategory')
            ->with('author')
            ->with('thumbnail')
            ->get();
        return view('site.pages.home', compact(['posts']));
    }

    public function show($slug)
    {
        $post = $this->post->where('slug', $slug)
        ->first();
        return view('site.pages.single-post', compact(['post']));
    }
}
