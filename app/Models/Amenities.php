<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    public $table = 'amenities';

    public $fillable = [ 'name', 'description', 'icon', 'label', 'types' ];

    public $timestamps = false;
    
    public function room() {
    	return $this->belongsToMany('App\Models\Room', 'amenities_room');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('types', '!=', $type);
    }
}
