<?php

use App\Models\Post;
use Illuminate\Support\Str;

if (!function_exists('recomendedPosts')) {
    function recommendedPosts(){
       return  Post::with('author')
            ->with('subcategory')
            ->with('thumbnail')
            ->limit(6)
            ->inRandomOrder()
            ->get();
    }
}

if (!function_exists('latestPost')) {
    function latestPost(){
        $latest_post = Post::orderBy('created_at', 'desc')
        ->limit(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->first();
        $latest_post->body = summarize($latest_post->body, 35);
        return $latest_post;
    }
}

if(!function_exists('summarize')){
    function summarize($value, $words = 10){
       return Str::ucfirst(Str::words(strip_tags($value), $words, '...'));
    }
}