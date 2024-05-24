<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    
    protected $fillable = [
        'title', 'body', 'thumb', 'slug', 'is_active', 'category_id', 'subcategory_id'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
    public function thumbnail(){
        return $this->hasOne(File::class, 'id', 'thumb');
    }
}
