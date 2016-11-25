<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

class RoomController extends Controller
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

    public function __construct( Property $property, Kind $kinds, 
    								Amenities $amenities, Space $spaces, 
    								BedType $bed_types, Room $room, Place_room $place_room,
    								Photo_room $photo_rooms ) {
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
			$this->show_process($data_Room);
		}
		$this->data['data_Room'] = $data_Room;
		$this->data['process_display'] = false;
		return view('admins.host.create', $this->data);
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

	/**
		Kind Room, property type
	*/

	public function getRoomCreate($room_ID = null) {
		$storage_room = '';

		if( !is_null($session = session()->get('host')) ) {
			if( isset($session['room_type']) ) {
				$storage_room = $session['room_type'];
			} else {
				session()->put('host.room_type', [
					'room' => false
				]);
			}
		}

		$properties = $this->property->select('id', 'name')->orderBy('id', 'asc')->get();
		$kinds		= $this->kinds->select('id', 'name', 'icon', 'slug')->orderBy('name', 'asc')->get();

		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}

		return view('admins.host.step1.room', compact('properties', 'kinds', 'storage_room', 'data_Room'));
	}

	public function postRoomCreate(Request $request, $room_ID = null) {
		$this->_validateRoomCreate($request);
		$store = [
			'kind_room_id' 		=> $request->kind_room_id,
			'property_type_id'	=> $request->property_type_id,
			'room' 				=> true,
			'completed_room' 	=> 100/6
		];
		$request->session()->put('host.room_type', $store);
		$_link = $request->_link;
		$route = 'host.bedrooms';
		return $this->_redirect_link($_link, $route);
	}

	public function editRoomCreate(Request $request, $room_ID) {
		$room_type = $this->room->findOrFail($room_ID);
		$data_Edit = [
			'kind_room_id' 		=> $request->kind_room_id,
			'property_type_id' 	=> $request->property_type_id,
		];

		$room_type->update($data_Edit);
		sleep(1);
		return redirect()->route('host.bedrooms', $room_ID);
	}

	protected function _validateRoomCreate(Request $request) {
		$this->validate($request, [
			'kind_room_id' => ['required']
		]);
	}

	/**
		Bedroom
	*/

	public function getBedroomCreate($room_ID = null) {
		$storage_bedroom = '';
		if( session()->has('host') ) {
            $session = session()->get('host');

            if( isset($session['bedroom']) ) {
				$storage_bedroom = $session['bedroom'];
			} else {
				session()->put('host.bedroom', [
					'bedroom' => false
				]);
			}
	    }

	    $bed_types = $this->bed_types->select('id', 'name')->get();

		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}

		return view('admins.host.step1.bedrooms', compact('bed_types', 'storage_bedroom', 'data_Room'));
	}

	public function postBedroomCreate(Request $request, $room = null) {
		$this->_validateBedroomCreate($request);
		
		$storeBedroom = [
			'count_bed' 	=> $request->bed_count,
			'count_guest' 	=> $request->guest_count,
			'bedroom_count' => $request->bedroom_count,
			'bed_types' 	=> $request->bed_types,
			'bedroom' 		=> true,
			'completed_bedroom' => 100/6
		];

		$request->session()->put('host.bedroom', $storeBedroom);

		$dataRequest = $request->session()->get('host');

		$_link = $request->_link;

		$route = 'host.bathrooms';

		return $this->_redirect_link($_link, $route);
	}

	public function editBedroomCreate(Request $request, $room_ID) {
		$bedroom_type = $this->room->findOrFail($room_ID);
		$data_Edit = [
			'count_bed' => $request->bed_count,
			'count_guest' => $request->guest_count,
			'bed_types' => $request->bed_types,
			'bedroom_count' => $request->bedroom_count,
		];

		$bedroom_type->update($data_Edit);
		sleep(1);
		return redirect()->route('host.bathrooms', $room_ID);
	}

	protected function _validateBedroomCreate(Request $request) {
		$this->validate($request, [
			'bedroom_count' => ['digits_between:0,16', 'numeric'],
			'bed_count' 	=> ['digits_between:0,16', 'numeric'],
			'guest_count' 	=> ['digits_between:0,16', 'numeric'],
		]);
	}

	/**
		Bathroom
	*/

	public function getBathroomCreate($room_ID = null) {
		$storage_bathroom = '';

		if( !is_null($session = session()->get('host')) ) {
			if(isset($session['bathroom'])) {
				$storage_bathroom = $session['bathroom'];
			} else {
				session()->put('host.bathroom', [
					'bathroom' => false
				]);
			}
		}

		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}
		return view('admins.host.step1.bathrooms', compact('storage_bathroom', 'data_Room'));
	}

	public function postBathroomCreate(Request $request, $room_ID = null) {
		$this->_validateBedroomCreate($request);

		$storeBathroom = [
			'bathroom_count' 		=> $request->bathroom_count,
			'bathroom_type' 		=> $request->bathroom_type,
			'bathroom' 				=> true,
			'completed_bathroom' 	=> 100/6
		];

		$request->session()->put('host.bathroom', $storeBathroom);

		$_link = $request->_link;

		$route = 'host.location';

		return $this->_redirect_link($_link, $route);
	}

	public function editBathroomCreate(Request $request, $room_ID) {
		$bathroom_type = $this->room->findOrFail($room_ID);
		$data_Edit = [
			'bathroom_count' => $request->bathroom_count,
		];

		$bathroom_type->update($data_Edit);
		sleep(1);
		return redirect()->route('host.location', $room_ID);
	}

	protected function _validateBathroomCreate(Request $request) {
		$this->validate($request, [
			'bathroom_count' => ['digits_between:0,8', 'numeric'],
		]);
	}


	/**
		Location
	*/

	public function getLocationCreate($room_ID = null) {
		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID)->with(['place_room'])->has('place_room')->first();
		}
		return view('admins.host.step1.location', compact('data_Room'));
	}

	public function postLocationCreate(Request $request, \App\Models\Place_room $place_room, $member = null) {
		$this->_validateBedroomCreate($request);

		$member_id = auth()->guard('dev')->user()->id;

    	$uuid = Uuid::uuid4();

		$data_storage = $request->session()->get('host');
		
		$room_type	= $data_storage['room_type'];
		$bedroom 	= $data_storage['bedroom'];
		$bathroom 	= $data_storage['bathroom'];

		$id = $uuid->toString();

		$data_insert = [
			'id' 				=> $id,
			'kind_room_id' 		=> $room_type['kind_room_id'],
			'property_type_id' 	=> $room_type['property_type_id'],
			'bed_types' 		=> $bedroom['bed_types'],
			'bedroom_count' 	=> $bedroom['bedroom_count'],
			'count_bed' 		=> $bedroom['count_bed'],
			'count_guest' 		=> $bedroom['count_guest'],
			'bathroom_count' 	=> $bathroom['bathroom_count'],
			'member_id' 		=> $member_id
		];

		$last_insert_room = $this->room->create($data_insert);

		$storeLocation = [
			'room_id'		=> $id,
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
		];

		sleep(1);

		$insert_place = $this->place_room->create($storeLocation);

		sleep(1);


		$location_Session = [
			'completed_location' => 100/6
		];

		$request->session()->put('host.location', $location_Session);

		return redirect()->route('host.amenities', $id);
	}

	public function editLocationCreate(Request $request, $room_ID) {
		$place_data_room = $this->place_room->where('room_id', $room_ID)->first();
		$data_Edit = [
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
		];

		$place_data_room->update($data_Edit);
		sleep(1);
		return redirect()->route('host.amenities', $room_ID);
	}

	protected function _validateLocationCreate(Request $request) {
		$this->validate($request, [
			'street' => ['required'],
		]);
	}


	/**
		Amenities
	*/

	public function getAmenitieCreate($room_ID = null) {
		$amenities_normal = $this->amenities->select('id', 'name', 'description')->where('types', 'normal')->get();
		$amenities_safety = $this->amenities->select('id', 'name', 'description')->where('types', 'safety')->get();
		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}

		return view('admins.host.step1.amenities', compact('amenities_normal', 'amenities_safety', 'room_ID', 'data_Room'));
	}

	public function postAmenitieCreate(Request $request, $room_ID = null) {
		$this->_validateBedroomCreate($request);

		$storeAmenities = [
			'completed_amenities' => 100/6
		];

		$request->session()->put('host.amenities', $storeAmenities);

		if( !is_null($room_ID) ) {
			$getRoom = $this->room->find($room_ID);
			$getRoom->amenities()->attach($request->amenities_id);
		}

		return redirect()->route('host.spaces', $room_ID);
	}

	public function editAmenitieCreate(Request $request, $room_ID) {
		$amenities_type = $this->room->findOrFail($room_ID);
		$amenities_type->amenities()->sync($request->amenities_id);
		sleep(1);
		return redirect()->route('host.spaces', $room_ID);
	}

	protected function _validateAmenitieCreate(Request $request) {
		$this->validate($request, [
			'street' => ['required'],
		]);
	}


	/**
		Amenities
	*/

	public function getSpaceCreate($room_ID = null) {
		$spaces = $this->spaces->select('id', 'name', 'description')->get();
		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}
		return view('admins.host.step1.spaces', compact('spaces', 'room_ID', 'data_Room'));
	}

	public function postSpaceCreate(Request $request, $room_ID = null) {
		if( !is_null($room_ID) ) {
			$getRoom = $this->room->find($room_ID);
			$getRoom->spaces()->attach($request->spaces_id);
		}

		$storeSpaces = [
			'completed_space' => 100/6
		];

		$request->session()->put('host.space', $storeSpaces);


		$data_storage = $request->session()->get('host');
		
		(int) $completed = 0;

		if(isset($data_storage['room_type']['completed_room'])) {
			$completed_room = $data_storage['room_type']['completed_room'];
		} else {
			$completed_room = 0;
		}

		if(isset($data_storage['bedroom']['completed_bedroom'])) {
			$completed_bedroom = $data_storage['bedroom']['completed_bedroom'];
		} else {
			$completed_bedroom = 0;
		}

		if(isset($data_storage['bathroom']['completed_bathroom'])) {
			$completed_bathroom = $data_storage['bathroom']['completed_bathroom'];
		} else {
			$completed_bathroom = 0;
		}

		if(isset($data_storage['location']['completed_location'])) {
			$completed_location = $data_storage['location']['completed_location'];
		} else {
			$completed_location = 0;
		}

		if(isset($data_storage['amenities']['completed_amenities'])) {
			$completed_amenities = $data_storage['amenities']['completed_amenities'];
		} else {
			$completed_amenities = 0;
		}

		if(isset($data_storage['space']['completed_space'])) {
			$completed_space = $data_storage['space']['completed_space'];
		} else {
			$completed_space = 0;
		}

		$completed = (float) $completed_space + (float) $completed_amenities + (float) $completed_location + (float) $completed_bedroom + (float) $completed_bathroom + (float) $completed_room;

		$process = [
			'completed' => $completed,
		];

		$this->process_one($room_ID, $process);

		// $request->session()->forget('host');
		return redirect()->route('admin.room.create', $room_ID);
	}

	private function process_one( $room_ID, $process ) {
		return \App\Models\Process::create(
			[
				'room_id' 	=>	$room_ID,
				'member_id' 	=>	auth()->guard('dev')->user()->id,
				'step_one' 	=> 	json_encode($process)
			]
		);
	}

	public function editSpaceCreate(Request $request, $room_ID) {
		$space_type = $this->room->findOrFail($room_ID);
		$space_type->spaces()->sync($request->spaces_id);
		sleep(1);
		$process = [
			'completed' => 100,
		];
		$this->process_one($room_ID, $process);
		// $request->session()->forget('host');
		return redirect()->route('admin.room.create', $room_ID);
	}

	/**
		public
	*/

	private function _redirect_link($_link, $route) {
		if($_link) {
			return redirect($_link);
		}
		else{
			return redirect()->route($route);
		}

	}

	// HighLights
	
	public function getHighlightCreate($room_ID = null) {
		$data_Room = '';
		$amenities_location = $this->amenities->select('id', 'name', 'description')->where('types', 'location')->get();
		$amenities_special = $this->amenities->select('id', 'name', 'description')->where('types', 'special')->get();
		$amenities_spaces = $this->amenities->select('id', 'name', 'description')->where('types', 'space_place')->get();
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}else {
			return redirect()->route('host.kindroom');
		}

		$this->show_process($data_Room);
		return view('admins.host.step2.highlights', $this->data, compact('amenities_location', 'amenities_special', 'amenities_spaces', 'room_ID', 'data_Room'));
	}

	public function postHighlightCreate(Request $request, $room_ID = null) {
		$data_Room = '';		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$data_Room->place_close = $request->place_close;
		$data_Room->space_special = $request->space_special;

		$data_Room->save();
		$space_places = $data_Room->amenities()->where('types', 'space_place')->select('id')->get()->toArray();
		foreach( $space_places as $space_place) {
			$data_Room->amenities()->detach($space_place['pivot']['amenities_id']);
		}
		$data_Room->amenities()->attach($request->amenities_id);

		$complete_step = $data_Room->process->step_two;
		$step_1 = [
			'step_1' => 100/4
		];
		$this->process_2($complete_step, $step_1, $room_ID);
		return redirect()->route('host.description', $room_ID);
	}

	// Description

	public function getDescriptionCreate($room_ID = null) {
		$data_Room = '';

		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$template = $this->makeDescription($data_Room);
		$this->show_process($data_Room);
		return view('admins.host.step2.description', $this->data, compact('room_ID', 'data_Room', 'template'));
	}

	private function makeDescription($data_Room) {
		$temp = $template = '';
		$place_close 	= $data_Room->place_close;
		$space_special 	= $data_Room->space_special;
		$convert_string_place_close		= is_array($place_close) ? 'Vị trí của tôi là gần với '.implode(', ', $place_close).'. ' : null;
		$convert_string_space_special	= is_array($space_special) ? 'Bạn sẽ yêu nơi tôi vì '.implode(', ', $space_special).'. ' : null;
		$amenitie_space = $data_Room->amenities->where('types', 'space_place')->toArray();
		foreach ($amenitie_space as $v) {
			$temp [] = $v['name'];
		}
		$convert_string_amenitie_space	= is_array($temp) ? 'Vị trí của tôi là tốt cho '.implode(', ', $temp).'.' : null;
		$template =  $convert_string_place_close . $convert_string_space_special . $convert_string_amenitie_space;
		return $template;
	}

	public function postDescriptionCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$data_Room->description = $request->description;
		$data_Room->save();

		$complete_step = $data_Room->process->step_two;
		$step_2 = [
			'step_2' => 100/4
		];
		$this->process_2($complete_step, $step_2, $room_ID);
		return redirect()->route('host.title', $room_ID);
	}

	// Title

	public function getTitleCreate($room_ID = null) {
		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}else {
			return redirect()->route('host.kindroom');
		}
		$this->show_process($data_Room);

		return view('admins.host.step2.title', $this->data, compact('room_ID', 'data_Room'));
	}

	public function postTitleCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$data_Room->title = $request->title;
		$data_Room->save();

		$complete_step = $data_Room->process->step_two;
		$step_3 = [
			'step_3' => 100/4
		];
		$this->process_2($complete_step, $step_3, $room_ID);
		return redirect()->route('host.photos', $room_ID);
	}

	// Photos

	public function getPhotosCreate($room_ID = null) {
		$data_Room = '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}else {
			return redirect()->route('host.kindroom');
		}
		$this->show_process($data_Room);

		return view('admins.host.step2.photos', $this->data, compact('room_ID', 'data_Room'));
	}

	public function postPhotosCreate(Request $request, $room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);

		if( \Request::ajax() ) {
			if($request->file('image')) {
				$validator = \Validator::make($request->all(), [
					'image' => 'mimes:jpeg,bmp,jpg,png,gif'
				]);
				if ($validator->fails()) {
					return response()->json(['error' => 'Định dạng upload không đúng'], 403);
				}

				$photo_ins = $this->photo_rooms->create([
					'room_id' => $room_ID,
				]);

				$photo_ins->setImage($request->file('image'));
			}

			return response('Upload thành công', 200)
					->header('Content-Type', 'text/plain');
		}

		$complete_step = $data_Room->process->step_two;
		$step_4 = [
			'step_4' => 100/4
		];
		if( empty($data_Room->photo_room->toArray()) ) {
			$step_4 = [
				'step_4' => 0
			];
		}
		$this->process_2($complete_step, $step_4, $room_ID);

		return redirect()->route('admin.room.create', $room_ID);
	}

	private function process_2 ($array_root, $array_push, $room_ID) {
		$data_Room = $this->getRoomID($room_ID);
		if( is_null($array_root) )
			$array_root = [];
		if( in_array($array_push, $array_root) )
			return ;
		@array_push($array_root, $array_push);
		$data_Room->process->step_two = json_encode($array_root);
		$data_Room->process->save();
	}

	public function getAPIPhotos($room_ID = null) {
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
			return $data_Room->photo_room->all();
		}
		
		return null;
	}

	public function deleteAPIPhotos($id, $room_ID = null) {
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
			$photo = $data_Room->photo_room->find($id);
			$currentImage = public_path($photo->name);
	        if(\File::isFile($currentImage)) {
	            \File::delete($currentImage);
	        }
	        $photo->delete();

			return response('Xóa thành công', 200)
					->header('Content-Type', 'text/plain');
		}
		return null;
	}

	public function updateAPIPhotos(Request $request, $id, $room_ID = null) {
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
			$photo = $data_Room->photo_room->find($id);
			if(!$photo) return ;
			if( \Request::ajax() ) {
				$photo->caption = $request->caption;
				$photo->save();
				return response('Cập nhật thành công', 200)
						->header('Content-Type', 'text/plain');
			}
		}
		return null;
	}

	// STEP 3 QUESTION

	// experience
	public function getExperienceCreate($room_ID = null) {
		$data_Room = $experience = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);

		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$experience = $data_Room->room_setting->experience_question;
		}
		$this->show_process($data_Room);
		return view('admins.host.step3.experience', $this->data, compact('room_ID', 'data_Room', 'experience'));
	}

	public function postExperienceCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$exper = [
				'room_id'		=> $data_Room->id,
				'experience_question' => $request->experience_question
			];
			$this->createSettingRoom($exper);
		} else {
			$data_Room->room_setting->experience_question = (int) $request->experience_question;
			$data_Room->room_setting->save();
		}

		$complete_step = $data_Room->process->step_three;
		$step_1 = [
			'step_1' => $this->step_three
		];
		$this->process_3($complete_step, $step_1, $room_ID);

		return redirect()->route('host.occupancy', $room_ID);
	}

	/*
		* PUBLIC CREATE SETTING
	*/

		public function createSettingRoom($data) {
			\App\Models\Room_setting::create($data);
		}

	//occupancy

	public function getOccupancyCreate($room_ID = null) {
		$data_Room = $occupancy = '';
		
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		if(!is_null($data_Room->room_setting) && $data_Room->room_setting != '' ) {
			$occupancy = $data_Room->room_setting->occupancy_question;
		}
		$this->show_process($data_Room);
		return view('admins.host.step3.occupancy', $this->data, compact('room_ID', 'data_Room', 'occupancy'));
	}

	public function postOccupancyCreate(Request $request, $room_ID = null) {
		$data_Room = '';
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$room_setting = $data_Room->room_setting;
		if(is_null($room_setting)) {
			$occup = [
				'room_id'		=> $data_Room->id,
				'occupancy_question' => $request->occupancy_question
			];
			$this->createSettingRoom($occup);
		} else {
			$data_Room->room_setting->occupancy_question = $request->occupancy_question;
			$data_Room->room_setting->save();
		}

		$complete_step = $data_Room->process->step_three;
		$step_2 = [
			'step_2' => $this->step_three
		];
		if( !isset($complete_step['step_2']) ) {
			$this->process_3($complete_step, $step_2, $room_ID);
		}

		return redirect()->route('host.booking', $room_ID);
	}

	//Booking

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

		$this->show_process($data_Room);
		return view('admins.host.step3.booking', $this->data, compact('room_ID', 'data_Room', 'booking', 'calendar'));
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

		$this->show_process($data_Room);
		return view('admins.host.step3.calendar', $this->data, compact('room_ID', 'data_Room', 'dates'));
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
		$this->show_process($data_Room);
		return view('admins.host.step3.trip_length', $this->data, compact('room_ID', 'data_Room', 'trip_min', 'trip_max'));
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
		$this->show_process($data_Room);
		return view('admins.host.step3.availability', $this->data, compact('room_ID', 'data_Room', 
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
		$this->show_process($data_Room);
		return view('admins.host.step3.choose_pricing_mode', $this->data, compact('room_ID', 'data_Room', 'pricing_mode'));
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

		$complete_step = $data_Room->process->step_three;
		$step_3 = [
			'step_3' => $this->step_three
		];
		if( !isset($complete_step['step_3']) ) {
			$this->process_3($complete_step, $step_3, $room_ID);
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
		$this->show_process($data_Room);
		return view('admins.host.step3.price', $this->data, compact('room_ID', 'data_Room', 'pricing_mode', 'min_price', 'max_price', 'base_price'));
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

		$complete_step = $data_Room->process->step_three;
		$step_4 = [
			'step_4' => $this->step_three
		];
		if( !isset($complete_step['step_4']) ) {
			$this->process_3($complete_step, $step_4, $room_ID);
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
		$this->show_process($data_Room);
		return view('admins.host.step3.additional_pricing', $this->data, compact('room_ID', 'data_Room', 'weekly_discount', 'monthly_discount'));
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
		$complete_step = $data_Room->process->step_three;
		$step_5 = [
			'step_5' => $this->step_three
		];
		if( !isset($complete_step['step_5']) ) {
			$this->process_3($complete_step, $step_5, $room_ID);
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
		return view('admins.host.step3.rules', $this->data, compact('room_ID', 'data_Room'));
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

		$complete_step = $data_Room->process->step_three;
		$step_6 = [
			'step_6' => $this->step_three
		];
		if( !isset($complete_step['step_6']) ) {
			$this->process_3($complete_step, $step_6, $room_ID);
		}
		
		return redirect()->route('host.locations_around', $room_ID);
	}

	private function process_3 ($array_root, $array_push, $room_ID) {
		$data_Room = $this->getRoomID($room_ID);
		if( is_null($array_root) )
			$array_root = [];
		if( in_array($array_push, $array_root) )
			return ;
		
		@array_push($array_root, $array_push);
		$data_Room->process->step_three = json_encode($array_root);
		$data_Room->process->save();
	}

	//SETTING LOCATION AROUND

	public function getLocationsAroundCreate($room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		return view('admins.host.locations_around', compact('room_ID'));
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
		return view('admins.host.checkin', $this->data, compact('room_ID'));
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

	public function postActiveCreate($room_ID = null) {
		if( is_null($room_ID) ) {
			return redirect()->route('host.kindroom');
		}
		$data_Room = $this->getRoomID($room_ID);
		$data_Room->publish = 1;
		$data_Room->save();
		return redirect()->route('admin.room', $room_ID);
	}
}
