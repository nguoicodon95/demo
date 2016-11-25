<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    public $table = 'kinds';

    public $fillable = [ 'name', 'description', 'icon', 'slug' ];

    public $timestamps = false;
    
    public function setSlugAttribute ( $string ) {
    	$slug = str_slug( $string );
    	$this->attributes['slug'] = $slug;
    }

    public function room() {
    	return $this->hasMany('App\Models\Room');
    }
}
