<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'path', 'type', 'author_id', 'description', 'size'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
   
}
