<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\storeMenuRequest;
use App\Http\Requests\editMenuRequest;
use App\Http\Controllers\Controller;

use App\Models\Menu;
use App\Models\MenuNode;

class MenuController extends Controller
{
    protected $view_dir = 'admins.build_admin.';
    
    public function index()
    {
        $menus = Menu::all();
         return view($this->view_dir.'menus.list', compact('menus'));
    }

    public function create(Menu $menu)
    {
        return view($this->view_dir.'menus.edit', compact('menu'));
    }

    public function store(storeMenuRequest $request)
    {
        $created = Menu::create([
            'name' => $request->name,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('name')),
            'status' => $request->status,
        ]);
        return redirect()->route('menus.builder', $created->id);
    }

    public function update(editMenuRequest $request, $id)
    {
        $menu = Menu::find($id);
        $updated = $menu->update([
            'name' => $request->name,
            'slug' => $request->get('slug') ? str_slug($request->get('slug')) : str_slug($request->get('name')),
            'status' => $request->status,
        ]);
        return redirect()->route('menus.builder', $id);
    }

    public function destroy($id) {
        $menu = Menu::find($id)->delete();
        return redirect()->route('menus.index');
    }

    public function builder($id)
    {
        $menu = Menu::find($id);
        if(!$menu) return redirect()->route('menus.index');
        return view($this->view_dir.'menus.edit', compact('menu'));
    }

    public function delete_menu($id)
    {
        $item = MenuNode::find($id);
        $menuId = $item->menu_id;
        $item->destroy($id);

        return redirect()
            ->route('menus.builder', [$menuId]);
    }

    public function add_item(Request $request)
    {
        $data = $request->all();

        if($request->menu_id == '')
            return redirect()->back();
        
        $highestOrderMenuItem = MenuNode::where('parent_id', '=', null)
            ->orderBy('order', 'DESC')
            ->first();

        $data['order'] = isset($highestOrderMenuItem->id)
            ? intval($highestOrderMenuItem->order) + 1
            : 1;

        MenuNode::create($data);

        return redirect()->route('menus.builder', $data['menu_id']);
    }

    public function update_item(Request $request)
    {
        $id = $request->input('id');
        $data = $request->except(['id']);
        $menuItem = MenuNode::find($id);
        $menuItem->update($data);

        return redirect()
            ->route('menus.builder', [$menuItem->menu_id]);
    }

    public function order_item(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));

        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $menuItem) {
            $item = MenuNode::find($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }

}
