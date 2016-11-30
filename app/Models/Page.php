<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    public $fillable = [
        'title',
        'slug',
        'page_template',
        'description',
        'content',
        'image',
        'keywords',
        'status'
    ];

}
