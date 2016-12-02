<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\storePropertyRequest;
use App\Http\Requests\updatePropertyRequest;
use App\Http\Requests\deleteRequest;
use App\Http\Controllers\Controller;

use App\Models\Property;
use Repositories\PropertyRepository;

class PropertyController extends BaseAdminController
{
    protected $property;

    public function __construct(PropertyRepository $property) {
        $this->property = $property;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = $this->property->all(['id', 'name', 'description']);
        return view($this->view_dir.'properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        return view($this->view_dir.'properties.form', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePropertyRequest $request)
    {
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        } else {
            $input['slug'] = $request->name; 
        };

        $last_insert = $this->property->create($input);

        return redirect(route('properties.index'))->with('status', 'Bạn đã vừa thêm thành công loại tài sản "<b>'.$last_insert->name.'"</b>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = $this->property->find($id);

        return view($this->view_dir.'properties.form', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updatePropertyRequest $request, $id)
    {
        $property = $this->property->find($id);

        $property->fill($request->only('name', 'label', 'description', 'icon', 'slug'))->save();
        
        return redirect(route('properties.edit', $property->id))->with('status', 'Bạn đã vừa cập nhật thành công loại tài sản "<b>'.$property->name.'"</b>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(deleteRequest $request, $id)
    {
        $this->property->delete($id);
        return redirect(route('properties.index'))->with('status', 'Bạn đã vừa xóa một loại tài sản.');
    }
}
