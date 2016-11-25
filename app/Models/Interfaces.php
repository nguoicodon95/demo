<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interfaces extends Model
{
    public $table = 'interfaces';
    public $fillable = [ 'location_id', 'room_id', 'position', 'config' ];
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function getConfigAttribute( $value ) {
        return json_decode($value);
    }
}
