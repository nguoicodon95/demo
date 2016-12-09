<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Room;
use App\Models\Interfaces;

use App\Models\Setting;

use DB;

class SettingsController extends BaseAdminController
{
	public $data;

	/* Cài đặt tổng quan */

	public function index()
    {
        $settings = Setting::orderBy('order', 'ASC')->get();

        return view($this->view_dir.'settings.index', compact('settings'));
    }

    public function create(Request $request)
    {
        $lastSetting = Setting::orderBy('order', 'DESC')->first();
        $order = intval($lastSetting->order) + 1;
        $request->merge(['order' => $order]);
        $request->merge(['value' => '']);
        Setting::create($request->all());

        return back()->with([
            'message'    => 'Successfully Created New Setting',
            'alert-type' => 'success',
        ]);
    }

    public function delete($id)
    {
        Setting::destroy($id);

        return back()->with([
            'message'    => 'Successfully Deleted Setting',
            'alert-type' => 'success',
        ]);
    }

    public function move_up($id)
    {
        $setting = Setting::find($id);
        $swapOrder = $setting->order;
        $previousSetting = Setting::where('order', '<', $swapOrder)->orderBy('order', 'DESC')->first();
        $data = [
            'message'    => 'This is already at the top of the list',
            'alert-type' => 'error',
        ];

        if (isset($previousSetting->order)) {
            $setting->order = $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => "Moved {$setting->display_name} setting order up",
                'alert-type' => 'success',
            ];
        }

        return back()->with($data);
    }

    public function delete_value($id)
    {
        $setting = Setting::find($id);

        if (isset($setting->id)) {
            // If the type is an image... Then delete it
            if ($setting->type == 'image') {
                if (Storage::exists(config('voyager.storage.subfolder').$setting->value)) {
                    Storage::delete(config('voyager.storage.subfolder').$setting->value);
                }
            }
            $setting->value = '';
            $setting->save();
        }

        return back()->with([
            'message'    => "Successfully removed {$setting->display_name} value",
            'alert-type' => 'success',
        ]);
    }

    public function move_down($id)
    {
        $setting = Setting::find($id);
        $swapOrder = $setting->order;

        $previousSetting = Setting::where('order', '>', $swapOrder)->orderBy('order', 'ASC')->first();
        $data = [
            'message'    => 'This is already at the bottom of the list',
            'alert-type' => 'error',
        ];

        if (isset($previousSetting->order)) {
            $setting->order = $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => "Moved {$setting->display_name} setting order down",
                'alert-type' => 'success',
            ];
        }

        return back()->with($data);
    }

    public function save(Request $request)
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $content = $this->getContentBasedOnType($request, 'settings', (object) [
                'type'    => $setting->type,
                'field'   => $setting->key,
                'details' => $setting->details,
            ]);

            if ($content === null && isset($setting->value)) {
                $content = $setting->value;
            }

            $setting->value = $content;
            $setting->save();
        }

        return back()->with([
            'message'    => 'Successfully Saved Settings',
            'alert-type' => 'success',
        ]);
    }

	/*Sắp xếp grid trang chủ*/

    public function interface (Request $request) {
    	if($get = $request->get('form')){
    		if($get == 'locations') {
		    	$this->data['rows'] = Location::all();
		    	$this->data['form'] = 'locations';
    		} elseif($get == 'host') {
		    	$this->data['rows'] = Room::where('publish', 1)->get();
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
				'image' => !empty($r['room']['photo_room']) ? $r['room']['photo_room'][0]['name'] : '',
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
    	return view($this->view_dir.'settings.interface.index', $this->data);
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

    private function getContentBasedOnType(Request $request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request->input($row->field);

                if (isset($pass_field) && !empty($pass_field)) {
                    return bcrypt($request->input($row->field));
                }
                break;

            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request->input($row->field);

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;
                break;

            /********** FILE TYPE **********/
            case 'file':
                $file = $request->file($row->field);
                $filename = Str::random(20);
                $path = $slug.'/'.date('F').date('Y').'/';

                $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

                Storage::put(config('voyager.storage.subfolder').$fullPath, (string) $file, 'public');

                return $fullPath;
                // no break

            /********** ALL OTHER TEXT TYPE **********/
            default:
                return $request->input($row->field);
                // no break
        }

        return $content;
    }
}
