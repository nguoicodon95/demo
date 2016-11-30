<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\storePageRequest;
use App\Http\Requests\editPageRequest;

use App\Http\Controllers\Controller;

use App\Models\Page;

class PagesController extends Controller
{
    protected $view_dir = 'admins.build_admin.';
    
    public function index()
    {
        $pages = Page::all();
        return view($this->view_dir.'pages.list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        return view($this->view_dir.'pages.edit', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePageRequest $request)
    {
        $data = [
            'title' => $request->title,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('title')),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image,
            'keywords' => $request->keywords,
        ];
        $created = Page::create($data);

        return redirect()->route('pages.index')->with('status', 'Create success!');
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
        $page = Page::find($id);
        return view($this->view_dir.'pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editPageRequest $request, $id)
    {
        $page = Page::find($id);
        $data = [
            'title' => $request->title,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('title')),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image,
            'keywords' => $request->keywords,
        ];
        $updated = $page->update($data);
        return redirect()->route('pages.index')->with('status', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if(!$page)
            return redirect()->back()->with('status', 'Not find page exists!');
        
        $page->delete();
        return redirect()->route('pages.index')->with('status', 'Delete success!');
    }
}
