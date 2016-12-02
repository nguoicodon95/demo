<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Location;
use File;

class LocationsController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return view($this->view_dir.'locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Location $locations)
    {
        return view($this->view_dir.'locations.form', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);
        $locations = Location::create([
            'name'          => $request->name,
            'slug'          => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('name')),
            'street'        => $request->name,
            'street_number' => $request->street_number,
            'route'         => $request->route,
            'locality'      => $request->locality,
            'city'          => $request->city,
            'state'         => $request->state,
            'country'       => $request->country,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'zipcode'       => $request->zipcode,
            'show_index'    => $request->show_index,
            'description'   => $request->description,
            'image'         => $request->image,
        ]);
        
        return redirect()->route('locations.index')->with('status', 'Bạn đã vừa thêm thành công một địa điểm.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locations = Location::findOrFail($id);
        return view($this->view_dir.'locations.form', compact('locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $locations = Location::findOrFail($id);
        $validator = $this->validator($request);
        $arr = [
            'name'          => $request->name,
            'street'        => $request->name,
            'street_number' => $request->street_number,
            'route'         => $request->route,
            'locality'      => $request->locality,
            'city'          => $request->city,
            'state'         => $request->state,
            'country'       => $request->country,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'zipcode'       => $request->zipcode,
            'show_index'    => $request->show_index,
            'description'   => $request->description,
            'image'         => $request->image,
        ];
        $locations->fill( $request->only('name', 'street_number', 'slug', 
                                        'route', 'city', 
                                        'locality', 'state', 'country', 
                                        'latitude', 'longitude', 'zipcode', 
                                        'description', 'show_index', 'image'))->save();
        $locations->slug = $request->slug;
        $locations->street = $request->name;
        $locations->save();
       
        return redirect()->route('locations.index')->with('status', 'Bạn đã vừa cập nhật thành công một địa điểm.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locations = Location::findOrFail($id);
        $locations->delete();
        return redirect(route('locations.index'))->with('status', 'Bạn đã vừa xóa một địa điểm.');
    }

    public function validator(Request $request) {
        $messages = [
            'required' => ':attribute không được để trống.',
            'unique' => ':attribute đã được thực hiện trước đó. Hãy tìm một :attribute mới.',
        ];

        return $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'slug' => 'required|unique:locations,slug,'.$request->route('location'),
        ], $messages);
    }
}
