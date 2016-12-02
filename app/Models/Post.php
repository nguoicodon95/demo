<?php

namespace App\Models;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public $fillable = [
        'category_id',
        'title',
        'slug',
        'page_template',
        'description',
        'content',
        'image',
        'keywords',
        'status'
    ];

    public function category () {
    	return $this->belongsTo('App\Models\Category');
    }
    
    public function getCreatedAtAttribute( $value ) {
    	return Carbon::parse($value)->format('d/m/Y H:i');
    }
}
