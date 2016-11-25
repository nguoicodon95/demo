<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    public $table = 'bed_types';

    public $fillable = [ 'name', 'description', 'slug' ];

    public $timestamps = false;
    
    public function setSlugAttribute ( $string ) {
    	$slug = str_slug( $string );
    	$this->attributes['slug'] = $slug;
    }
}
