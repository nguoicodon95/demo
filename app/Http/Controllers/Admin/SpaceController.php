<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\storeSpaceRequest;
use App\Http\Requests\updateSpaceRequest;
use App\Http\Requests\deleteRequest;
use App\Http\Controllers\Controller;

use App\Models\Space;
use Repositories\SpaceRepository;

class SpaceController extends BaseAdminController
{
    protected $spaces;

    public function __construct(SpaceRepository $spaces) {
        $this->spaces = $spaces;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spaces = $this->spaces->all(['id', 'name', 'label', 'description', 'icon']);
        return view($this->view_dir.'space.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Space $space)
    {
        return view($this->view_dir.'space.form', compact('space'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeSpaceRequest $request)
    {
        $this->spaces->create($request->only('name', 'label', 'description', 'icon'));
        return redirect(route('spaces.index'))->with('status', 'Bạn đã vừa thêm thành công một tiện ích.');
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
        $space = $this->spaces->find($id);
        return view($this->view_dir.'space.form', compact('space'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateSpaceRequest $request, $id)
    {
        $space = $this->spaces->find($id);

        $space->fill($request->only('name', 'label', 'description', 'icon'))->save();
        
        return redirect(route('spaces.edit', $space->id))->with('status', 'Bạn đã vừa cập nhật thành công một tiện ích.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(deleteRequest $request, $id)
    {
        $this->spaces->delete($id);
        return redirect(route('spaces.index'))->with('status', 'Bạn đã vừa xóa một tiện ích.');
    }
}
