<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room_setting extends Model
{
    protected $table = 'room_settings';

    protected $fillable = [
        'room_id', 'experience_question', 'occupancy_question', 'calendar', 'min_trip_length', 'max_trip_length', 'advance_notice',
        'preparation_time', 'booking_window', 'pricing_mode', 'min_price', 'max_price', 'base_price', 'weekly_discount', 'monthly_discount'
    ];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function getCalendarAttribute( $value ) {
        $value = json_decode($value);
        $value = explode(', ', $value);
        return $value;
    }

    public function getRulesAttribute( $value ) {
        return json_decode($value);
    }

    public function getCheckInAttribute( $value ) {
        return json_decode($value);
    }
}
