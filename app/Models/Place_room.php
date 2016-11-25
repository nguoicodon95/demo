<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class Place_room extends Model
{
    protected $table = 'place_rooms';

    protected $fillable = [
        'room_id', 'street_number', 'route', 'street', 'city', 'locality', 'state',
        'country', 'latitude', 'longitude', 'zipcode'
    ];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function setImage(UploadedFile $uploadFile) {
        $currentImage = public_path($this->name);
        $timeNow = Carbon::now();
        $fileExt = $uploadFile->getClientOriginalExtension();
        $fileName = nameRand().'.'.$fileExt;
        if(!File::isDirectory(public_path('uploads/products'))) {
            File::makeDirectory(public_path('uploads/products'));
        }
        $uploadFile->move(public_path('uploads/library'), $fileName);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        $this->name = 'uploads/products/'.$fileName;
        $this->save();
        return true;
    }

}
