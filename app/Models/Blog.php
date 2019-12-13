<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['blog_title', 'category_id', 'slug', 'blog_description'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
