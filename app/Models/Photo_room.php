<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;


class Photo_room extends Model
{
    protected $table = 'photo_rooms';

    protected $fillable = [
        'room_id', 'name', 'caption', 'cover'
    ];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

  /*  public function setImage(UploadedFile $uploadFile) {
        $currentImage = public_path($this->name);
        $fileExt = $uploadFile->getClientOriginalExtension();
        $fileName = nameRand().'.'.$fileExt;
        if(!File::isDirectory(public_path('uploads/libraries'))) {
            File::makeDirectory(public_path('uploads/libraries'), 0775, true);
        }
        $uploadFile->move(public_path('uploads/libraries'), $fileName);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        $this->name = $fileName;
        $this->save();
        return true;
    }
*/
    /*public function getNameAttribute( $value ) {
        return '/uploads/libraries/'.$value;
    }*/
}
