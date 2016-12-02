<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\storeCategoryRequest;
use App\Http\Requests\editCategoryRequest;
use App\Http\Controllers\Controller;
use \App\Models\Category;

class CategoriesController extends BaseAdminController
{
   
    public function index()
    {
        $categories = Category::all();
        return view($this->view_dir.'categories.list', compact('categories'));
    }

    public function create(Category $category)
    {
        $obj = Category::all();
        $categories = $this->_recursiveGetCategoriesSelectSrc($obj, 0, 'title', 'asc', 0, 0, []);
        $this->data['categoriesHtmlSrc'] = $categories;
        return view($this->view_dir.'categories.edit', $this->data,  compact('category'));
    }

    public function store(storeCategoryRequest $request)
    {
        $data = [
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('title')),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image,
            'keywords' => $request->keywords,
        ];
        $created = Category::create($data);

        return redirect()->route('categories.index')->with('status', 'Create success!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $obj = Category::all();
        $categories = $this->_recursiveGetCategoriesSelectSrc($obj, 0, 'title', 'asc', 0, $category->parent_id, [$id]);
        $this->data['categoriesHtmlSrc'] = $categories;
        return view($this->view_dir.'categories.edit', $this->data,  compact('category'));
    }

    public function update(editCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $data = [
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('title')),
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image,
            'keywords' => $request->keywords,
        ];
        $updated = $category->update($data);

        return redirect()->route('categories.index')->with('status', 'Updated success!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category)
            return redirect()->back()->with('status', 'Not find category exists!');
        
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Delete success!');
    }


    private function _recursiveGetCategoriesSelectSrc($object, $parentId, $orderBy = 'id', $orderType = 'asc', $childText = 0, $selectedNode = 0, $exceptIds = [])
    {
        $updateTo = '';
        $child = '';
        for ($i = 0; $i < $childText; $i++) {
            $child .= '——';
        }

        $categories = $object->where('parent_id', '=', $parentId);

        foreach ($categories as $key => $row) {
            $updateTo .= '<option value="' . $row->id . '"' . (($row->id == $selectedNode) ? ' selected="selected"' : '') . '>' . $child . ' ' . $row->title . '</option>';
            $updateTo .= $this->_recursiveGetCategoriesSelectSrc($object, $row->id, $orderBy, $orderType, $childText + 1, $selectedNode, $exceptIds);

        }
        return $updateTo;
    }

}
