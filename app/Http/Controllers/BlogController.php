<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\ConditionalRules;

class BlogController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        $posts = $this->post->orderBy('updated_at', 'desc')
            ->limit(6)
            ->where('is_active', 1)
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
        if ($slug == 'articles') {
            return  $this->showPosts();
        }
        $post = $this->post->where('slug', $slug)
            ->where('is_active', 1)
            ->first();
        return view('site.pages.single-post', compact(['post']));
    }
    public function showPosts()
    {
        $posts = $this->post->where('is_active', 1)->paginate(9);
        return view('site.pages.posts', compact(['posts']));
    }
    public function showCategory($category_slug, $subcategory_slug = null)
    {
        if (!$subcategory_slug) {
            $category = Category::where('slug', $category_slug)->first();
            if ($category) {
                $posts = $this->post->where('category_id', $category->id)->where('is_active', 1)->paginate(6);
            } else {
                $posts = [];
            }
        } else {
            $category = SubCategory::where('slug', $subcategory_slug)->first();
            if ($category) {
                if ($category->parentCategory->slug == $category_slug) {
                    $posts = $this->post->where('subcategory_id', $category->id)->where('is_active', 1)->paginate(6);
                } else {
                    $posts = [];
                }
            } else {
                $posts = [];
            }
        }


        return view('site.pages.categories', compact(['posts', 'category']));
    }
}
