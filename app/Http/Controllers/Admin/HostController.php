<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Room;

class HostController extends Controller
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
    	
    	return view('admins.host.room', compact('listings'));
    }
}
