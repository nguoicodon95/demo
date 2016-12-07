<?php

namespace App\Models;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $primaryKey = 'id';

    public $incrementing = 'false';

    protected $table = 'rooms';

    protected $fillable = [
        'id', 'member_id', 'kind_room_id', 'property_type_id', 
        'property_type_id', 'bedroom_count', 'bedroom_count', 
        'count_bed', 'bed_types', 'count_guest', 'bathroom_count',
        'place_close', 'space_special', 'title', 'description'
    ];

    public function scopeMemberId($query, $id)
    {
        return $query->where('member_id', $id);
    }

    public function photo_room()
    {
        return $this->hasMany('App\Models\Photo_room');
    }

    public function locations_around()
    {
        return $this->hasMany('App\Models\Locations_around');
    }

    public function place_room()
    {
        return $this->hasOne('App\Models\Place_room');
    }

    public function room_setting()
    {
        return $this->hasOne('App\Models\Room_setting');
    }

    public function kind() {
    	return $this->belongsTo('App\Models\Kind', 'kind_room_id');
    }

    public function process() {
        return $this->hasOne('App\Models\Process');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property', 'property_type_id');
    }

    public function interfaces() {
    	return $this->hasMany('App\Models\Interfaces');
    }

    public function spaces() {
    	return $this->belongsToMany('App\Models\Space', 'spaces_room');
    }

    public function amenities() {
        return $this->belongsToMany('\App\Models\Amenities', 'amenities_room');
    }

    public function getIdAttribute($value) {
        return (string) $value;
    }

    public function member() {
        return $this->belongsTo('App\Models\Member');
    }

    public function getUpdatedAtAttribute( $value ) {
        return Carbon::parse($value)->diffForHumans();
    }

    public function setPlaceCloseAttribute( $value ) {
        $this->attributes['place_close'] = json_encode($value);
    }
    public function getPlaceCloseAttribute( $value ) {
        return json_decode($value);
    }

    public function setSpaceSpecialAttribute( $value ) {
        $this->attributes['space_special'] = json_encode($value);
    }
    
    public function getSpaceSpecialAttribute( $value ) {
        return json_decode($value);
    }

    public function scopeSearchBy($query, $relation, $type)
    {
        return $query->where(function($query) use($relation, $type) {
                $query->whereIn('kind_room_id', $type);
        })->get();
    }
}
