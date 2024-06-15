<?php

use App\Models\Post;
use Illuminate\Support\Str;

if (!function_exists('recommendedPosts')) {
    function recommendedPosts(){
       return  Post::with('author')
            ->with('subcategory')
            ->with('thumbnail')
            ->limit(6)
            ->inRandomOrder()
            ->get();
            
    }
}
if (!function_exists('recommendedPost')) {
    function recommendedPost(){
         return  Post::inRandomOrder()->limit(1)->get();
    }
}

if (!function_exists('latestPost')) {
    function latestPost(){
        $latest_post = Post::orderBy('updated_at', 'desc')
        ->where('is_active', 1)
        ->limit(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->first();
        if ($latest_post) {
            $latest_post->body = summarize($latest_post->body, 35);
        }
        return $latest_post;
    }
}

if(!function_exists('summarize')){
    function summarize($value, $words = 10){
       return Str::ucfirst(Str::words(strip_tags($value), $words, '...'));
    }
}