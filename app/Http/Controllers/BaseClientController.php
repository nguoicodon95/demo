<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Room;

class BaseClientController extends Controller
{
	protected $listings;
	protected $data;
	protected $rooms;

    public function __construct(Room $rooms) {
    	$this->rooms = $rooms;
        $this->data['show_form'] = true;

		$this->data['relatedRoom'] = $this->_getLastedRoom();
    }

	private function _getLastedRoom() {
		return Room::where('publish', 1)->take(2)->get();
	}
}
