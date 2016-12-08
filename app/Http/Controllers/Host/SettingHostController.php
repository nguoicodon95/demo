<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseAdminController;

use App\Models\Room;
use App\Models\Photo_room;
use App\Models\Locations_around;
use App\Models\Amenities;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
class SettingHostController extends BaseAdminController
{
	protected $data;

    private function getRoomID($room_ID) {
		$member_ID = auth()->guard('dev')->user()->id;
    	$roomElement = Room::where([ 'id' => $room_ID ,'member_id' => $member_ID])->first();
    	if(!$roomElement) abort(404);
    	return $roomElement;
    }

    public function getForm ($room_ID = null) {
		$amenities_location = Amenities::select('id', 'name', 'description')->where('types', 'location')->get();
		$amenities_special = Amenities::select('id', 'name', 'description')->where('types', 'special')->get();
		$amenities_spaces = Amenities::select('id', 'name', 'description')->where('types', 'space_place')->get();
		$data_Room 	= '';
		if( is_null($room_ID) ) {
			return redirect()->route('admin.room.create');
		}
		$data_Room = $this->getRoomID($room_ID);
		$this->data['data_Room'] 	= $data_Room;
		$this->data['amenities_location'] 	= $amenities_location;
		$this->data['amenities_special'] 	= $amenities_special;
		$this->data['amenities_spaces'] 	= $amenities_spaces;

		return view($this->view_dir.'host.step2.global_form_settings', $this->data);
	}

	public function postForm(Request $request, $room_ID = null) {
		$data_Room 	= '';
		if( is_null($room_ID) ) {
			return redirect()->route('admin.room.create');
		}
		$validator = \Validator::make($request->all(), [
			'description' => ['required'],
			'title' => ['required'],
		]);

		if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
		
		$data_Room = $this->getRoomID($room_ID);

		$data_Room->description = $request->description;
		$data_Room->title = $request->title;
		$data_Room->save();

		$space_places = $data_Room->amenities()->where('types', 'space_place')->select('id')->get()->toArray();
		foreach( $space_places as $space_place) {
			$data_Room->amenities()->detach($space_place['pivot']['amenities_id']);
		}

		$data_Room->amenities()->attach($request->amenities_id);
		
		if($request->photo) {
			Photo_room::where('room_id', $room_ID)->delete();
			foreach($request->photo as $photo) {
				if($photo != '') {
					Photo_room::create([
						'room_id' => $room_ID,
						'name' => $photo,
					]);
				}
			}
		}
		$data_Room->process()->update([
			'step_two' 	=> 	true
		]);
		
		return redirect()->route('admin.room.create', $room_ID);
	}
/*
	public function removePhoto($id) {
		$photo = Photo_room::find($id);
		return $photo->delete();
	}*/

}
