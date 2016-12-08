<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseAdminController;
use Illuminate\Http\Response;

use App\Models\Property;
use App\Models\Kind;
use App\Models\Amenities;
use App\Models\Space;
use App\Models\BedType;
use App\Models\RoomRoom;
use App\Models\Room;
use App\Models\Place_room;
use App\Models\Photo_room;
use App\Models\Locations_around;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class RoomController extends BaseAdminController
{
    protected $property;
    protected $kinds;
    protected $amenities;
    protected $spaces;
    protected $bed_types;
    protected $room;
    protected $place_room;
    protected $place_rooms;

    protected $data;

    protected $step_three;

    public function __construct(Property $property, Kind $kinds, 
    							Amenities $amenities, Space $spaces, 
    							BedType $bed_types, Room $room, Place_room $place_room,
    							Photo_room $photo_rooms )
	{
        $this->property 	= $property;
        $this->kinds 		= $kinds;
        $this->amenities 	= $amenities;
        $this->spaces 		= $spaces;
        $this->bed_types 	= $bed_types;
        $this->room 		= $room;
        $this->place_room 	= $place_room;
        $this->photo_rooms 	= $photo_rooms;

		setlocale(LC_TIME, '');
		\Carbon\Carbon::setLocale('vi');

		$this->step_three = round(100/6,12);
    }

    private function getRoomID($room_ID) {
		$member_ID = auth()->guard('dev')->user()->id;
    	$roomElement = $this->room->where([ 'id' => $room_ID ,'member_id' => $member_ID])->first();
    	if(!$roomElement) abort(404);
    	return $roomElement;
    }

	public function index($room_ID = null) {
		session()->forget('host');
		$data_Room = '';
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}
		$this->data['data_Room'] = $data_Room;
		$this->data['process_display'] = false;
		return view($this->view_dir.'host.create', $this->data);
	}

	private function show_process($data_Room) {
		$this->data['process_two'] = $this->convert_step($data_Room->process->step_two);
		$this->data['process_three'] = $this->convert_step($data_Room->process->step_three);
		return $this->data;
	}

	private function convert_step($_array) {
        $collection = collect($_array);
        $collapsed = $collection->collapse();
        return $this->total_process($collapsed);
	}

	private function total_process($collapsed) {
		return $collapsed->sum();
	}

	//Booking
	public function createSettingRoom($data) {
		\App\Models\Room_setting::create($data);
	}

	public function getBookingCreate($room_ID = null) {
		$data_Room = $booking = $calendar = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$booking = $data_Room->room_setting;
			$dateNow = \Carbon\Carbon::now();
			$parseCalendar = \Carbon\Carbon::parse($booking->calendar[0]);
			if($parseCalendar->toDateString() == $dateNow->toDateString()) {
				$parseCalendar->addDays(3);
			}
			$begin 			= $dateNow->addDay()->toDateString();
			$end 			= \Carbon\Carbon::now()->addMonths(3)->toDateString();
			$allDayBetween 	= $this->rangeDates($begin, $end);
			foreach ( $allDayBetween as $day) {
				if(!in_array($day, $booking->calendar)) {
					$dates[] 		= $day;
				}
			}
			$calendar = \Carbon\Carbon::parse($dates[0])->formatLocalized('%A, %d %B %Y');
		}
		if($calendar == '') {
			$calendar = 'mỗi ngày';
		}

		return view($this->view_dir.'host.step3.booking', compact('room_ID', 'data_Room', 'booking', 'calendar'));
	}

	public function rangeDates($begin, $end) {
		$begin 		= new \DateTime( $begin );
		$end 		= new \DateTime( $end );
		$interval 	= new \DateInterval('P1D');
		$daterange 	= new \DatePeriod($begin, $interval ,$end);
		foreach($daterange as $date){ 
			$dayBetween[] = $date->format("Y-m-d"); 
		}
		return $dayBetween;
	}

	//Calendar

	public function getCalendarCreate($room_ID = null) {
		$data_Room = $dates = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$dates = json_encode($data_Room->room_setting->calendar);
		}

		return view($this->view_dir.'host.step3.calendar', compact('room_ID', 'data_Room', 'dates'));
	}

	public function postCalendarCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$calend = [
				'room_id'		=> $data_Room->id,
				'calendar' => json_encode($request->calendar)
			];
			$this->createSettingRoom($calend);
		} else {
			$data_Room->room_setting->calendar = json_encode($request->calendar);
			$data_Room->room_setting->save();
		}

		return redirect()->route('host.booking', $room_ID);
	}

	//Trip length

	public function getTripLengthCreate($room_ID = null) {
		$data_Room = '';
		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$trip_min = $data_Room->room_setting->min_trip_length;
			$trip_max = $data_Room->room_setting->max_trip_length;
		}
		return view($this->view_dir.'host.step3.trip_length', compact('room_ID', 'data_Room', 'trip_min', 'trip_max'));
	}

	public function postTripLengthCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		// dd($request->all());
		if(is_null($room_setting)) {
			$trip_length = [
				'room_id'		=> $data_Room->id,
				'min_trip_length' => $request->min_trip_length,
				'max_trip_length' => $request->max_trip_length
			];
			$this->createSettingRoom($trip_length);
		} else {
			$data_Room->room_setting->min_trip_length = $request->min_trip_length;
			$data_Room->room_setting->max_trip_length = $request->max_trip_length;
			$data_Room->room_setting->save();
		}

		return redirect()->route('host.booking', $room_ID);
	}
	//availability

	public function getAvailabilityCreate($room_ID = null) {
		$data_Room = '';
		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room 			= $this->getRoomID($room_ID);
		$room_setting 		= $data_Room->room_setting;
		$advance_notice 	= $room_setting->advance_notice;
		$booking_lead_time 	= $room_setting->booking_lead_time;
		$preparation_time 	= $room_setting->preparation_time;
		$booking_window 	= $room_setting->booking_window;
		return view($this->view_dir.'host.step3.availability', compact('room_ID', 'data_Room', 
																'advance_notice', 'booking_lead_time',
																'preparation_time', 'booking_window'));
	}
	
	public function postAvailabilityCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		// dd($request->all());
		if(is_null($room_setting)) {
			$avail = [
				'room_id'		=> $data_Room->id,
				'advance_notice' => $request->advance_notice,
				'booking_lead_time' => $request->booking_lead_time,
				'preparation_time' => $request->preparation_time,
				'booking_window' => $request->booking_window
			];
			$this->createSettingRoom($avail);
		} else {
			$data_Room->room_setting->advance_notice = $request->advance_notice;
			$data_Room->room_setting->booking_lead_time = $request->booking_lead_time;
			$data_Room->room_setting->preparation_time = $request->preparation_time;
			$data_Room->room_setting->booking_window = $request->booking_window;
			$data_Room->room_setting->save();
		}

		return redirect()->route('host.booking', $room_ID);
	}

	//Pricing model

	public function getChoosePricingModeCreate($room_ID = null) {
		$pricing_mode = $occupancy = '';
		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$pricing_mode = $data_Room->room_setting->pricing_mode;
		}
		return view($this->view_dir.'host.step3.choose_pricing_mode', compact('room_ID', 'data_Room', 'pricing_mode'));
	}

	public function postChoosePricingModeCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$occup = [
				'room_id'		=> $data_Room->id,
				'pricing_mode'		=> $request->pricing_mode,
			];
			$this->createSettingRoom($occup);
		} else {
			$data_Room->room_setting->pricing_mode = $request->pricing_mode;
			$data_Room->room_setting->save();
		}

		return redirect()->route('host.price', $room_ID);
	}

	//Pricing model

	public function getPriceCreate($room_ID = null) {
		$pricing_mode = $occupancy = '';
		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$pricing_mode	= $data_Room->room_setting->pricing_mode;
			$min_price		= $data_Room->room_setting->min_price;
			$max_price		= $data_Room->room_setting->max_price;
			$base_price		= $data_Room->room_setting->base_price;
		}
		return view($this->view_dir.'host.step3.price', compact('room_ID', 'data_Room', 'pricing_mode', 'min_price', 'max_price', 'base_price'));
	}

	public function postPriceCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;

		// dd($request->all());

		if(is_null($room_setting)) {
			$occup = [
				'room_id'		=> $data_Room->id,
				'min_price'		=> $request->min_price,
				'max_price'		=> $request->max_price,
				'base_price'	=> $request->base_price,
				'currency'		=> $request->currency,
			];
			$this->createSettingRoom($occup);
		} else {
			$data_Room->room_setting->min_price 	= $request->min_price;
			$data_Room->room_setting->max_price 	= $request->max_price;
			$data_Room->room_setting->base_price 	= $request->base_price;
			$data_Room->room_setting->currency 		= $request->currency;
			$data_Room->room_setting->save();
		}

		return redirect()->route('host.addpricing', $room_ID);
	}

	//Pricing model

	public function getAdditionalPricingCreate(Request $request, $room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$weekly_discount	= $data_Room->room_setting->weekly_discount;
			$monthly_discount	= $data_Room->room_setting->monthly_discount;
		}
		return view($this->view_dir.'host.step3.additional_pricing', compact('room_ID', 'data_Room', 'weekly_discount', 'monthly_discount'));
	}

	public function postAdditionalPricingCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$occup = [
				'room_id'			=> $data_Room->id,
				'weekly_discount'	=> $request->weekly_discount,
				'monthly_discount'	=> $request->monthly_discount,
			];
			$this->createSettingRoom($occup);
		} else {
			$data_Room->room_setting->weekly_discount 	= $request->weekly_discount;
			$data_Room->room_setting->monthly_discount 	= $request->monthly_discount;
			$data_Room->room_setting->save();
		}
		return redirect()->route('host.rules', $room_ID);
	}

	//House Rules

	public function getHouseRulesCreate($room_ID = null) {
		$data_Room = '';
		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room 			= $this->getRoomID($room_ID);
		$this->data['amenities'] = $this->amenities->where('types', 'rules')->get();
		$this->show_process($data_Room);
		$this->data['house_rules'] = $data_Room->room_setting->rules;
		return view($this->view_dir.'host.step3.rules', $this->data, compact('room_ID', 'data_Room'));
	}

	public function postHouseRulesCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$rules = [
				'room_id'	=> $data_Room->id,
				'rules'		=> json_encode($request->rules),
			];
			$this->createSettingRoom($rules);
		} else {
			$data_Room->room_setting->rules 	= json_encode($request->rules);
			$data_Room->room_setting->save();
		}

		$amenities_rules = $data_Room->amenities()->where('types', 'rules')->select('id')->get()->toArray();
		foreach( $amenities_rules as $_rules) {
			$data_Room->amenities()->detach($_rules['pivot']['amenities_id']);
		}
		$data_Room->amenities()->attach($request->amenities_id);

		return redirect()->route('host.locations_around', $room_ID);
	}

	//SETTING LOCATION AROUND

	public function getLocationsAroundCreate($room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		return view($this->view_dir.'host.locations_around', compact('room_ID'));
	}

	public function postLocationsAroundCreate(Request $request, $room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if( \Request::ajax() ) {
			$locations_around = Locations_around::create([
				'room_id' => $room_ID,
				'location_name' => $request->location_name,
				'street' 		=> $request->street,
				'street_number' => $request->street_number,
				'route' 		=> $request->route,
				'locality' 		=> $request->locality,
				'city' 			=> $request->city,
				'state' 		=> $request->state,
				'country' 		=> $request->country,
				'latitude' 		=> $request->latitude,
				'longitude' 	=> $request->longitude,
				'zipcode' 		=> $request->zipcode,
			]);

			if($request->file('marker_icon')) {
				$validator = \Validator::make($request->all(), [
					'marker_icon' => 'mimes:jpeg,bmp,jpg,png,gif'
				]);
				if ($validator->fails()) {
					return response()->json(['error' => 'Định dạng hình ảnh không đúng'], 403);
				}
				$locations_around->setImage($request->file('marker_icon'));
			}
		}
        return response(null, Response::HTTP_CREATED);
    }

	public function getAPILocationsAround($room_ID = null) {
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
			return $data_Room->locations_around->all();
		}
		
		return null;
	}

	public function deleteAPILocationsAround($id, $room_ID = null) {
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
			$_locations = $data_Room->locations_around->find($id);
			$icon = public_path($_locations->marker_icon);
	        if(\File::isFile($icon)) {
	            \File::delete($icon);
	        }
	        $_locations->delete();

			return response('Xóa thành công', 200)
					->header('Content-Type', 'text/plain');
		}
		return null;
	}

	// Checkin - checkout

	public function getCheckinCreate($room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$this->data['check_in'] = $data_Room->room_setting->check_in;
			$this->data['check_out'] = $data_Room->room_setting->check_out;
		}
		return view($this->view_dir.'host.checkin', $this->data, compact('room_ID'));
	}


	public function postCheckinCreate(Request $request, $room_ID = null) {
		$check_in_time_select = $request->input('check-in-time-select');
		$check_in_time_ends_select = $request->input('check-in-time-ends-select');
		$check_in = [
			'check_in_time_select' => $check_in_time_select,
			'check_in_time_ends_select' => $check_in_time_ends_select,
		];
		$check_in = json_encode($check_in);
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$rules = [
				'room_id'	=> $data_Room->id,
				'check_in'		=> $check_in,
				'check_out'		=> $request->check_out,
			];
			$this->createSettingRoom($rules);
		} else {
			$data_Room->room_setting->check_in 	= $check_in;
			$data_Room->room_setting->check_out = $request->check_out;
			$data_Room->room_setting->save();
		}

		$data_Room->process()->update([
			'step_three' 	=> 	true
		]);
		
		return redirect()->route('admin.room', $room_ID);
	}

	//Active

	public function getActiveCreate($room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$this->show_process($data_Room);
		return view('admins.host.finish', $this->data, compact('room_ID'));
	}

	public function postActiveCreate(Request $request, $room_ID) {
		$data_Room = $this->getRoomID($room_ID);
		$data_Room->publish = $request->active;
		$data_Room->save();
		return redirect()->route('admin.room');
	}

	public function statusUpdate(Request $request, $room_ID) {
		$data_Room = $this->getRoomID($room_ID);
		$data_Room->status = $request->status;
		$data_Room->save();
		return redirect()->route('admin.room');
	}
}
