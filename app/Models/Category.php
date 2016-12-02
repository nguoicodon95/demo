<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $fillable = [
        'parent_id',
        'title',
        'slug',
        'page_template',
        'description',
        'content',
        'image',
        'keywords',
        'status'
    ];

    public function posts () {
        // return $this->hasMany('\App\Models\Post');
        return $this->hasMany(Post::class)
            ->where('status', '=', 'activated')
            ->orderBy('created_at', 'DESC');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
}
