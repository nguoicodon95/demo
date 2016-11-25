<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class Locations_around extends Model
{
    protected $table = 'locations_arounds';

    protected $fillable = [
        'room_id', 'location_name', 'street_number', 'route', 'street', 'city', 'locality', 'state',
        'country', 'latitude', 'longitude', 'zipcode'
    ];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function setImage(UploadedFile $uploadFile) {
        $currentImage = public_path('uploads/libraries/icon/'.$this->marker_icon);
        $fileExt = $uploadFile->getClientOriginalExtension();
        $fileName = nameRand().'.'.$fileExt;
        if(!File::isDirectory(public_path('uploads/libraries/icon'))) {
            File::makeDirectory(public_path('uploads/libraries/icon'), 0775, true);
        }
        $uploadFile->move(public_path('uploads/libraries/icon'), $fileName);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        $this->marker_icon = $fileName;
        $this->save();
        return true;
    }

    public function getMarkerIconAttribute( $value ) {
        return '/uploads/libraries/icon/'.$value;
    }
}
