<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Room;

class HostController extends BaseAdminController
{
	protected $rooms;
	public function __construct(Room $rooms) {
		$this->rooms = $rooms;
	}

	private function memberID() {
		return auth()->guard('dev')->user()->id;
	}

    public function listing() {
    	$member_id = $this->memberID();
    	$listings = $this->rooms->memberId($member_id)->with('place_room', 'kind', 'photo_room')->get();
    	
    	return view($this->view_dir.'host.room', compact('listings'));
    }

	public function deleteHost($id) {
    	$member_id = $this->memberID();
		$rs_host = $this->rooms->where([ 'id' => $id ,'member_id' => $member_id])->first();
		if(!$rs_host) return redirect()->route('admin.room');
		$rs_host->amenities()->detach();
		$rs_host->spaces()->detach();
		$rs_host->photo_room()->delete();
		$rs_host->process()->delete();
		$rs_host->interfaces()->delete();
		$rs_host->place_room()->delete();
		$rs_host->locations_around()->delete();
		$rs_host->delete();
		return redirect()->route('admin.room');
	}
}
