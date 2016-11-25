<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $table = 'properties';

    public $fillable = [ 'name', 'slug', 'description' ];

    public $timestamps = false;

    public function setSlugAttribute ( $string ) {
    	$slug = str_slug( $string );
    	$this->attributes['slug'] = $slug;
    }
    
    public function room() {
    	return $this->hasMany('App\Models\Room');
    }
}
