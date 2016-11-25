<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    public $table = 'processes';

    public $fillable = [ 'room_id', 'member_id', 'step_one', 'step_two', 'step_three', 'completed' ];

    public $timestamps = false;
    
    public function room() {
    	return $this->belongsTo('App\Models\Room');
    }

    public function getStepOneAttribute($value)
    {
        return json_decode($value, true);
    }
    public function getStepTwoAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getStepThreeAttribute($value)
    {
        return json_decode($value, true);
    }
}
