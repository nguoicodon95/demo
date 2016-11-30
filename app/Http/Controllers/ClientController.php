<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Amenities;
use App\Models\Interfaces;
use App\Models\Location;
use App\Models\Room;
use App\Models\Kind;

class ClientController extends BaseClientController
{
    protected $data;

    public function index() {
        $rooms = Interfaces::with('room.photo_room', 'room.room_setting', 'room.place_room')->where('room_id', '!=', '')->get()->toArray();
        $rooms_items = $locations_items = array();
        foreach ($rooms as $r) {
            $rooms_items[] = [
                'key' => $r['id'],
                'id' => $r['room_id'],
                'position' => $r['position'],
                'name' => $r['room']['title'],
                'image' => $r['room']['photo_room'][0]['name'],
                'config' => $r['config'],
                'price' => $r['room']['room_setting']['base_price'],
                'types' => 'room',
                'place' => !is_null($r['room']['place_room']['state']) ? $r['room']['place_room']['state'].', '. $r['room']['place_room']['city'] : $r['room']['place_room']['city'] 
            ];
        }
        $locations = Interfaces::with('location')->where('location_id', '!=', '')->get()->toArray();
        foreach ($locations as $l) {
            $locations_items[] = [
                'key' => $l['id'],
                'id' => $l['location']['slug'],
                'position' => $l['position'],
                'name' => $l['location']['name'],
                'image' => $l['location']['image'],
                'config' => $l['config'],
                'price' => '',
                'types' => 'location'
            ];
        }
        $collection = collect([$rooms_items, $locations_items]);
        $this->data['items'] = $collection->collapse()->sortBy('position');

        $this->data['show_form'] = false;
        return view('defaults.index', $this->data);
    }

    public function room(Request $request, $location = null) {
        $location = Location::where('slug', $location)->first();
        $this->data['amenities'] = Amenities::ofType('rules')->get();
		$this->data['kind'] = Kind::all();
        $this->data['center'] = $location;
        $this->data['dt_filter'] = $request->all();
        /* Request location find from client */
        if($location) {
            $this->data['location_request'] =  $location->name;
        } else {
            $location_request = $request->location;
            $this->data['location_lat'] = $request->lat;
            $this->data['location_lng'] = $request->lng;
            $location_request = str_replace('--', ', ', $location_request);
            $this->data['location_request'] = str_replace('-', ' ', $location_request);
        }

        if($request->ajax()) {
            $filter = $request->all();
            $listings = $this->rooms->with('place_room', 'kind', 'photo_room', 'room_setting');
            /* Filter bedrooms */
            if( isset($filter['bedrooms']) && $filter['bedrooms'] > 0 ) {
                $listings = $listings->where('bedroom_count', $filter['bedrooms']);
            }
            /* Filter bathrooms */
            if( isset($filter['bathrooms']) && $filter['bathrooms'] > 0 ) {
                $listings = $listings->where('bathroom_count', $filter['bathrooms']);
            }
            /* Filter guest */
            if( isset($filter['guests']) && $filter['guests'] > 0 ) {
                $listings = $listings->where('count_guest', $filter['guests']);
            }
            /* Filter kind */
            if( isset($filter['kind']) ) {
                $listings = $listings->whereIn('kind_room_id', $filter['kind']);
            }
             /* Filter price between */
            if( isset($filter['price-min']) && isset($filter['price-max']) ) {
                $price_min = str_replace(['.', ' đ'], '', $filter['price-min']);
                $price_max = str_replace(['.', ' đ'], '', $filter['price-max']);
             
                $listings = $listings->whereExists(function ($query) use($price_min, $price_max) {
                    $query->select(\DB::raw(1))
                        ->from('room_settings')
                        ->whereRaw('room_settings.room_id = rooms.id')
                        ->whereBetween('room_settings.base_price', [$price_min, $price_max]);
                });
            }
            /* Filter checkin */
            if( isset($filter['check-in']) ) {
                $listings = $listings->whereExists(function ($query) use($filter) {
                    $query->select(\DB::raw(1))
                        ->from('room_settings')
                        ->whereRaw('room_settings.room_id = rooms.id')
                        ->where('room_settings.calendar', 'not like', '%'. $filter['check-in'] .'%');
                });
            }
            
            /* Filter type */
            if( isset($filter['type']) ) {
                $listings = $listings->whereExists(function ($query) use($filter) {
                    $query->select(\DB::raw(1))
                        ->from('amenities_room')
                        ->whereRaw('amenities_room.room_id = rooms.id')
                        ->whereIn('amenities_room.amenities_id', $filter['type']);
                });
            }

            $listings = $listings->get();

            $makers = array();
            $i = 0;
            foreach ($listings as $listing) {
                $i++;
                $photos = $listing->photo_room->pluck('name')->toArray();
                $makers[] = [
                    "id" => $i,
                    "type" => $listing->kind->name,
                    "type_icon" =>  $listing->kind->icon,
                    "title" => $listing->title,
                    "location" => isset($listing->state) && isset($listing->city) ? $listing->state.', '.$listing->city : $listing->place_room->state.', '.$listing->place_room->city,
                    "latitude" => isset($listing->latitude) ? $listing->latitude : $listing->place_room->latitude,
                    "longitude" => isset($listing->longitude) ? $listing->longitude : $listing->place_room->longitude,
                    "url" => route('room.detail', $listing->id),
                    "rating" => 4,
                    "gallery" => $photos,
                    "date_created" => "2014-11-03",
                    "price" =>  _formatPrice($listing->room_setting->base_price),
                    "guest" => $listing->count_guest,
                    "description" => $listing->description,
                    "last_review_rating" => 5
                ];
            }
            $data = [
                'data' => $makers
            ];
            return response()->json($data);
        }

        return view('defaults.rooms', $this->data);
    }

    //Json room all
   /* public function roomMaker( Request $request ) {
        $listings = $this->rooms->with('place_room', 'kind', 'photo_room', 'room_setting')->orderBy('id', 'desc')->get();
    	$this->data['listings'] = $listings;
        $makers = array();
        $i = 0;
    	foreach ($this->data['listings'] as $listing) {
        	$i++;
			$photos = $listing->photo_room->pluck('name')->toArray();
           
    		$makers[] = [
                "id" => $i,
                "type" => $listing->kind->name,
                "type_icon" =>  $listing->kind->icon,
                "title" => $listing->title,
                "location" => $listing->place_room->state.', '.$listing->place_room->city,
                "latitude" => $listing->place_room->latitude,
                "longitude" => $listing->place_room->longitude,
                "url" => route('room.detail', $listing->id),
                "rating" => 4,
                "gallery" => $photos,
                "features" => [
                    "Outdoor Kitchen",
                    "Sauna",
                    "Trees and Landscaping"
                ],
                "date_created" => "2014-11-03",
                "price" => _formatPrice($listing->room_setting->base_price),
                "featured" => 0,
                "color" => "",
                "person_id" => 1,
                "year" => 1980,
                "special_offer" => 0,
                "guest" => $listing->count_guest,
                "description" => $listing->description,
                "last_review" => "Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet",
                "last_review_rating" => 5
			];
    	}
    	$data = [
    		'data' => $makers
    	];
    	return response()->json($data);
    }*/

    /* Filter */

    public function __filterFeature( Request $request ) {



    }

    //single room detail
    public function singleRoom ( $id ) {
        $room = $this->rooms->with('place_room', 'member', 'kind', 'amenities', 'photo_room')->findOrFail($id);
        $this->data['room']             = $room;
        $this->data['amenities']        = Amenities::where('types', 'normal')->get();
        $this->data['rules']            = $room->amenities->where('types', 'rules');
        $this->data['photo_cover']      = $room->photo_room->first()->name;
        $this->data['locations_around'] = $room->locations_around->all();
        $this->data['rules_settings']   = $room->room_setting->rules;

        $check_in         = $room->room_setting->check_in;
        if(isset($check_in) && $check_in != NULL && !empty($check_in)) {
            if($check_in->check_in_time_ends_select == 'Flexible') {
                $this->data['check_in']     = 'Bất cứ lúc nào sau '.$check_in->check_in_time_select.':00';
            } else {
                $this->data['check_in']     = $check_in->check_in_time_select.':00 - '.$check_in->check_in_time_ends_select.':00';
            }
        }

        $this->data['check_out']        = $check_in;
        $this->data['check_out']        = $room->room_setting->check_out;
        $this->data['availability']     = $room->room_setting->min_trip_length;
        $this->data['weekly_discount']  = $room->room_setting->weekly_discount;
        $this->data['monthly_discount'] = $room->room_setting->monthly_discount;

        return view('defaults.single-room', $this->data);
    }

    //get photo room 
    public function __photo_room($id) {
        $room = $this->rooms->with('photo_room')->findOrFail($id);
        $photos = $room->photo_room;
        foreach ( $photos as $photo) {
            $images[] = [
                'src' => $photo->name,
                'alt' => $room->title,
                'title' => $room->title,
                'caption' => !is_null($photo->caption) ? $photo->caption : $room->title ,
            ];
        }
        return response()->json($images);
    }

    //get around locations
    public function __around_locations($id) {
        $room = $this->rooms->with('photo_room')->findOrFail($id);
        $locations_around = $room->locations_around->all();
        $around = [];
        foreach ($locations_around as $v) {
            $around[] = [
                $v->latitude,  $v->longitude, asset($v->marker_icon), $v->location_name, $v->street
            ];
        }
        // $this->data['around'] = $around;
        return response()->json($around);
    }

    public function _listingsRoom() { //->where('status', 1)
        return $this->rooms->with('place_room', 'kind', 'photo_room', 'room_setting')->orderBy('id', 'desc')->get();
    }
}
