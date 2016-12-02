<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class Location extends Model
{
     protected $table = 'locations';

    protected $fillable = [
        'name', 'slug', 'street_number', 'route', 'street', 'city', 'locality', 'state',
        'country', 'latitude', 'longitude', 'zipcode',
        'image', 'description', 'show_index'
    ];
    // public $timestamps = false;
    
    public function setSlugAttribute ( $string ) {
        $slug = str_slug( $string );
        $this->attributes['slug'] = $slug;
    }

    public function interfaces() {
        return $this->hasMany('App\Models\Interfaces');
    }
}
