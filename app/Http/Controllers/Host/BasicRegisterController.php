<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseAdminController;

use App\Models\Property;
use App\Models\Kind;
use App\Models\Amenities;
use App\Models\Space;
use App\Models\BedType;
use App\Models\Room;
use App\Models\Place_room;
use App\Models\Process;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class BasicRegisterController extends BaseAdminController
{
	protected $data;

	private function getRoomID($room_ID) {
		$member_ID = auth()->guard('dev')->user()->id;
    	$roomElement = Room::where([ 'id' => $room_ID ,'member_id' => $member_ID])->first();
    	if(!$roomElement) abort(404);
    	return $roomElement;
    }

	public function getForm ($room_ID = null) {

		$properties = Property::select('id', 'name')->orderBy('id', 'asc')->get();
		$kinds		= Kind::select('id', 'name', 'icon', 'slug')->orderBy('name', 'asc')->get();
	    $bed_types 	= BedType::select('id', 'name')->get();
		$amenities_normal = Amenities::select('id', 'name', 'description')->where('types', 'normal')->get();
		$amenities_safety = Amenities::select('id', 'name', 'description')->where('types', 'safety')->get();
		$spaces 	= Space::select('id', 'name', 'description')->get();
		$data_Room 	= '';
		
		if( !is_null($room_ID) ) {
			$data_Room = $this->getRoomID($room_ID);
		}

		$this->data['properties'] 	= $properties;
		$this->data['kinds'] 		= $kinds;
		$this->data['data_Room'] 	= $data_Room;
		$this->data['bed_types'] 	= $bed_types;
		$this->data['amenities_normal'] = $amenities_normal;
		$this->data['amenities_safety'] = $amenities_safety;
		$this->data['spaces'] 		= $spaces;


		return view($this->view_dir.'host.step1.global_form_basic', $this->data);
	}

	public function postForm(Request $request, $room_ID = null) {
		$validator = \Validator::make($request->all(), [
			'kind_room_id' => ['required'],
			'bedroom_count' => ['digits_between:0,16', 'numeric'],
			'bed_count' 	=> ['digits_between:0,16', 'numeric'],
			'guest_count' 	=> ['digits_between:0,16', 'numeric'],
			'bathroom_count' => ['digits_between:0,8', 'numeric'],
			'street' => ['required'],
			'city' => ['required'],
		]);
		if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
		$member_id = auth()->guard('dev')->user()->id;

    	$uuid = Uuid::uuid4();
		$id = $uuid->toString();

		$data_insert = [
			'id' 				=> $id,
			'kind_room_id' 		=> $request->kind_room_id,
			'property_type_id' 	=> $request->property_type_id,
			'bed_types' 		=> $request->bed_types,
			'bedroom_count' 	=> $request->bedroom_count,
			'count_bed' 		=> $request->bed_count,
			'count_guest' 		=> $request->guest_count,
			'bathroom_count' 	=> $request->bathroom_count,
			'member_id' 		=> $member_id
		];

		Room::create($data_insert);
		$last_insert_room = Room::find($id);
		$last_insert_room->amenities()->attach($request->amenities_id);
		$last_insert_room->spaces()->attach($request->spaces_id);

		$storeLocation = [
			// 'room_id'		=> $id,
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

		$insert_place = $last_insert_room->place_room()->create($storeLocation);

		$last_insert_room->process()->create([
			'member_id' 	=>	auth()->guard('dev')->user()->id,
			'step_one' 	=> 	true
		]);
		return redirect()->route('admin.room.create', $last_insert_room->id);
	}

	public function updateForm(Request $request, $room_ID) {
		$validator = \Validator::make($request->all(), [
			'kind_room_id' => ['required'],
			'bedroom_count' => ['digits_between:0,16', 'numeric'],
			'bed_count' 	=> ['digits_between:0,16', 'numeric'],
			'guest_count' 	=> ['digits_between:0,16', 'numeric'],
			'bathroom_count' => ['digits_between:0,8', 'numeric'],
			'street' => ['required'],
			'city' => ['required'],
		]);
		if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
		$member_id = auth()->guard('dev')->user()->id;

		$data_insert = [
			'kind_room_id' 		=> $request->kind_room_id,
			'property_type_id' 	=> $request->property_type_id,
			'bed_types' 		=> $request->bed_types,
			'bedroom_count' 	=> $request->bedroom_count,
			'count_bed' 		=> $request->bed_count,
			'count_guest' 		=> $request->guest_count,
			'bathroom_count' 	=> $request->bathroom_count,
			'member_id' 		=> $member_id
		];

		$_getHost = $this->getRoomID($room_ID);
		$_getHost->update($data_insert);
		$_getHost->amenities()->sync($request->amenities_id);
		$_getHost->spaces()->sync($request->spaces_id);

		$storeLocation = [
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

		$insert_place = $_getHost->place_room()->update($storeLocation);

		return redirect()->route('admin.room.create', $room_ID);
	}


}
