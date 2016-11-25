<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class Location extends Model
{
     protected $table = 'locations';

    protected $fillable = [
        'name', 'street_number', 'route', 'street', 'city', 'locality', 'state',
        'country', 'latitude', 'longitude', 'zipcode',
        'image', 'description', 'show_index'
    ];
    // public $timestamps = false;

    public function setImage(UploadedFile $uploadFile) {
        $currentImage = public_path('uploads/libraries/locations/'.$this->image);
        $fileExt = $uploadFile->getClientOriginalExtension();
        $fileName = nameRand().'.'.$fileExt;
        if(!File::isDirectory(public_path('uploads/libraries/locations'))) {
            File::makeDirectory(public_path('uploads/libraries/locations'), 0775, true);
        }
        $uploadFile->move(public_path('uploads/libraries/locations'), $fileName);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        $this->image = $fileName;
        $this->save();
        return true;
    }

    public function getImageAttribute( $value ) {
        return '/uploads/libraries/locations/'.$value;
    }
    
    public function setSlugAttribute ( $string ) {
        $slug = str_slug( $string );
        $this->attributes['slug'] = $slug;
    }

    public function interfaces() {
        return $this->hasMany('App\Models\Interfaces');
    }
}
