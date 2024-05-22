<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description','slug'];
    use HasFactory;

    public function child(){
        return $this->hasMany(SubCategory::class, 'parent_id', 'id');
    }

    public function parent(){
        return ($this->belongsTo(Category::class, 'parent_id', 'id'));
    }

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    

}
