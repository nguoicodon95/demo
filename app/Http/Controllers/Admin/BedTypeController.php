<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\storeBedTypeRequest;
use App\Http\Requests\updateBedTypeRequest;
use App\Http\Requests\deleteRequest;
use App\Http\Controllers\Controller;

use App\Models\BedType;
use Repositories\BedTypeRepository;

class BedTypeController extends Controller
{
    protected $bed_types;

    public function __construct(BedTypeRepository $bed_types) {
        $this->bed_types = $bed_types;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bed_types = $this->bed_types->all(['id', 'name', 'description']);
        return view('admins.bed_type.index', compact('bed_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BedType $bed_type)
    {
        return view('admins.bed_type.form', compact('bed_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeBedTypeRequest $request)
    {
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        } else {
            $input['slug'] = $request->name;
        };
        $last_insert = $this->bed_types->create($input);
        return redirect(route('bed_types.index'))->with('status', 'Bạn đã vừa thêm thành công loại giường ngủ "<b>'. $last_insert->name .'</b>".');
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
        $bed_type = $this->bed_types->find($id);

        return view('admins.bed_type.form', compact('bed_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateBedTypeRequest $request, $id)
    {
        $bed_type = $this->bed_types->find($id);

        $bed_type->fill($request->only('name', 'description'))->save();
        
        return redirect(route('bed_types.edit', $bed_type->id))->with('status', 'Bạn đã vừa cập nhật thành công loại giường ngủ "<b>'. $bed_type->name .'</b>".');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bed_types->delete($id);
        return redirect(route('bed_types.index'))->with('status', 'Bạn đã vừa xóa một loại giường ngủ.');
    }
}
