<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Room;
use App\Models\Interfaces;

use DB;

class SettingsController extends Controller
{
	public $data;

    public function interface (Request $request) {
    	if($get = $request->get('form')){
    		if($get == 'locations') {
		    	$this->data['rows'] = Location::all();
		    	$this->data['form'] = 'locations';
    		} elseif($get == 'host') {
		    	$this->data['rows'] = Room::all();
		    	$this->data['form'] = 'host';
    		}
    	} else {
	    	$this->data['rows'] = Location::all();
	    	$this->data['form'] = 'host';
    	}

    	$rooms = Interfaces::with('room.photo_room')->where('room_id', '!=', '')->get()->toArray();
    	$rooms_items = $locations_items = array();
		foreach ($rooms as $r) {
			$rooms_items[] = [
				'key' => $r['id'],
				'id' => $r['room_id'],
				'position' => $r['position'],
				'name' => $r['room']['title'],
				'image' => $r['room']['photo_room'][0]['name'],
				'config' => $r['config'],
			];
		}
    	$locations = Interfaces::with('location')->where('location_id', '!=', '')->get()->toArray();
    	foreach ($locations as $l) {
			$locations_items[] = [
				'key' => $l['id'],
				'id' => $l['location_id'],
				'position' => $l['position'],
				'name' => $l['location']['name'],
				'image' => $l['location']['image'],
				'config' => $l['config'],
			];
		}
		$collection = collect([$rooms_items, $locations_items]);
		$this->data['items'] = $collection->collapse()->sortBy('position');
		$convert = $this->data['items']->map(function ($value, $key) {
		    return $value['id'];
		});
		$this->data['all_id'] = $convert->toArray();
    	return view('admins.settings.interface.index', $this->data);
    }

    public function insInterface(Request $request, $id) {
    	$num_rows = Interfaces::all()->count();
    	if($get = $request->get('form')){
    		if($get == 'locations') {
    			$location = Location::findOrFail($id);
    			$ins = [
    				'location_id' => $location->id,
    				'position' => $num_rows + 1,
    			];
		    	Interfaces::create($ins);
    		} elseif($get == 'host') {
    			$room = Room::findOrFail($id);
    			$position = $room->position;
    			$ins = [
    				'room_id' => $room->id,
    				'position' => $num_rows + 1,
    			];
		    	Interfaces::create($ins);
    		}
    	}
    	return redirect()->back()->with([ 'status' => 'Great!' ]);
    }

    public function updatePosition (Request $request) {
    	$order = 0;
    	if( \Request::ajax() ) {
    		$data = (string) $request->data;
    		if(str_contains($data, '&')) {
    			$data = str_replace('&', '', $data);
    		}
    		$items = explode('item[]=', $data);
			foreach ( $items as $item ) {
				DB::table('interfaces')->where('id', $item)->update(['position' => $order]);
				$order++;
			}
		}
    }

    public function updateConfig (Request $request) {
    	if( \Request::ajax() ) {
    		$interface = Interfaces::find($request->id);
    		$value = [
    			'width' => $request->value
    		];
    		$interface->config = json_encode($value);
    		$interface->save();
		}
    }

    public function deleteElement (Request $request, $id) {
		$interface = Interfaces::find($request->id);
		$interface->delete();
		return redirect()->back()->with([ 'status' => 'Bạn vừa ẩn một hiển thị.' ]);
    }
}
