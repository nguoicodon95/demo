<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\storeAmenitiesRequest;
use App\Http\Requests\UpdateAmenitiesRequest;
use App\Http\Requests\deleteRequest;
use App\Http\Controllers\Controller;

use App\Models\Amenities;
use Repositories\AmenitiesRepository;

class AmenitiesController extends BaseAdminController
{
    protected $amenities;

    protected $types = [ 'safety', 'normal', 'location', 'special', 'space_place', 'rules' ];

    public function __construct( AmenitiesRepository $amenities ) {

        $this->amenities = $amenities;
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities = $this->amenities->all(['id', 'name', 'label', 'description', 'icon', 'types']);
        return view($this->view_dir.'amenities.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Amenities $amen)
    {
        return view($this->view_dir.'amenities.form', compact('amen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeAmenitiesRequest $request)
    {
        if(!in_array($request->types, $this->types)) {
            return redirect()->back()->withErrors([
                'types' => 'Loại tiện nghi không hợp lệ. Hãy thử lại!'
            ]);
        }

        $this->amenities->create($request->only('name', 'label', 'description', 'icon', 'types'));

        return redirect(route('amenities.index'))->with('status', 'Bạn đã vừa thêm thành công một tiện ích.');
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
        $amen = $this->amenities->find($id);
        return view($this->view_dir.'amenities.form', compact('amen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAmenitiesRequest $request, $id)
    {
        if(!in_array($request->types, $this->types)) {
            return redirect()->back()->withErrors([
                'types' => 'Loại tiện nghi không hợp lệ. Hãy thử lại!'
            ]);
        }

        $amen = $this->amenities->find($id);

        $amen->fill($request->only('name', 'label', 'description', 'icon', 'types'))->save();
        
        return redirect(route('amenities.edit', $amen->id))->with('status', 'Bạn đã vừa cập nhật thành công một tiện ích.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(deleteRequest $request, $id)
    {
        $this->amenities->delete($id);
        return redirect(route('amenities.index'))->with('status', 'Bạn đã vừa xóa một tiện ích.');
    }
}
