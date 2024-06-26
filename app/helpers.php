<?php

use App\Models\Post;
use Illuminate\Support\Str;


/**
 * shows a random list of 6 posts
 */
if (!function_exists('recommendedPosts')) {
    function recommendedPosts(){
       return  Post::with('author')
            ->with('subcategory')
            ->with('thumbnail')
            ->limit(12)
            ->inRandomOrder()
            ->get();     
    }
}
/**
 * Returns a single random post
 */
if (!function_exists('recommendedPost')) {
    function recommendedPost(){
         return  Post::inRandomOrder()->limit(1)->get();
    }
}
/**
 * Returns the latest modified post
 */
if (!function_exists('latestPost')) {
    function latestPost(){
        $latest_post = Post::orderBy('updated_at', 'desc')
        ->where('is_active', 1)
        ->limit(1)
        ->with('category')
        ->with('subcategory')
        ->with('author')
        ->with('thumbnail')
        ->get();
        
        return $latest_post;
    }
}
/**
 * Returns a summarized text
 */
if(!function_exists('summarize')){
    function summarize($value, $words = 10){
       return Str::ucfirst(Str::words(strip_tags($value), $words, '...'));
    }
}
/**
 * Returns article reading duration
 */
if (!function_exists('readDuration()')) {
    function readDuration(...$text){
        Str::macro('timeCounter', function($text){
            $total_words = str_word_count(implode(" ", $text));
            $minutes_to_read = round($total_words/200);
            return (int) max(1, $minutes_to_read);
        });
        return Str::timeCounter($text);
    }
}
/**Returns a secure password */

if (!function_exists('generatePassword')) {
    function generatePassword($length){
        $characters = '0123456789abcdefghijklmlnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i=0; $i < $length; $i++) { 
            $randomString .=$characters[rand(0, $charactersLength -1)];
        }
        return $randomString;
    }
}