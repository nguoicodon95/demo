<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\storeKindRequest;
use App\Http\Requests\updateKindRequest;
use App\Http\Requests\deleteRequest;
use App\Http\Controllers\Controller;

use App\Models\Kind;
use Repositories\KindRepository;

class KindController extends BaseAdminController
{
    protected $kinds;

    public function __construct(KindRepository $kinds) {
        $this->kinds = $kinds;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kinds = $this->kinds->all(['id', 'name', 'description', 'icon']);
        return view($this->view_dir.'kind.index', compact('kinds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kind $kind)
    {
        return view($this->view_dir.'kind.form', compact('kind'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeKindRequest $request)
    {
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        } else {
            $input['slug'] = $request->name; 
        };

        $last_insert = $this->kinds->create($input);

        return redirect(route('kinds.index'))->with('status', 'Bạn đã vừa thêm thành công loại phòng "<b>'. $last_insert->name .'</b>".');
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
        $kind = $this->kinds->find($id);

        return view($this->view_dir.'kind.form', compact('kind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateKindRequest $request, $id)
    {
        $kind = $this->kinds->find($id);

        $kind->fill($request->only('name', 'description', 'icon', 'slug'))->save();
        
        return redirect(route('kinds.edit', $kind->id))->with('status', 'Bạn đã vừa cập nhật thành công loại phòng "<b>'. $kind->name .'</b>".');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(deleteRequest $request, $id)
    {
        $this->kinds->delete($id);
        return redirect(route('kinds.index'))->with('status', 'Bạn đã vừa xóa một loại phòng.');
    }
}
