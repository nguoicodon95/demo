<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;
use App\Http\Requests\editPostRequest;
use App\Http\Controllers\Controller;
use \App\Models\Post;
use \App\Models\Category;

class PostsController extends BaseAdminController
{
    public function index()
    {
        $posts = Post::all();
        return view($this->view_dir.'posts.list', compact('posts'));
    }

    public function create(Post $post)
    {
        $categories = Category::all();
        return view($this->view_dir.'posts.edit', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
         $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('title')),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image,
            'keywords' => $request->keywords,
        ];
        $created = Post::create($data);

        return redirect()->route('posts.index')->with('status', 'Create success!');
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
        $post = Post::find($id);
        $categories = Category::all();
        return view($this->view_dir.'posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editPostRequest $request, $id)
    {
        $post = Post::find($id);
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('title')),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image,
            'keywords' => $request->keywords,
        ];
        $updated = $post->update($data);

        return redirect()->route('posts.index')->with('status', 'Updated success!');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!$post)
            return redirect()->back()->with('status', 'Not find post exists!');
        
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Delete success!');
    }
}
