<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    public $table = 'spaces';

    public $fillable = [ 'name', 'description', 'icon', 'label' ];

    public $timestamps = false;
    
    public function room() {
    	return $this->belongsToMany('App\Models\Room', 'spaces_room');
    }
}
