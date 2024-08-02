<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all menus
        $menus = Menu::with('parent')->get();

        // Fetch all users
        $users = User::all();

        // Pass both menus and users to the view
        return view('admin.menus.index', compact('menus', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::whereNull('parent_id')->get(); // Fetch parent menus
        return view('admin.menus.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|unique:menus',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'route' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'display_order' => 'nullable|integer',
            'level' => 'required|in:admin,client',
            'status' => 'required|boolean',
        ]);

        // Create a new menu
        Menu::create([
            'title' => $request->input('title'),
            'icon' => $request->input('icon'),
            'url' => $request->input('url'),
            'route' => $request->input('route'),
            'parent_id' => $request->input('parent_id'),
            'display_order' => $request->input('display_order', 0),
            'level' => $request->input('level'),
            'status' => $request->input('status'),
        ]);

        // Redirect to the index route
        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = (new Menu())->parentsOnly();
        $menus = Menu::whereNull('parent_id')->get();
        return view('admin.menus.edit', compact('menu','menus', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'route' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'display_order' => 'nullable|integer',
            'level' => 'required|in:admin,client',
            'status' => 'required|boolean',
        ]);

        // Update the menu fields
        $menu->title = $request->input('title');
        $menu->icon = $request->input('icon');
        $menu->url = $request->input('url');
        $menu->route = $request->input('route');
        $menu->parent_id = $request->input('parent_id');
        $menu->display_order = $request->input('display_order', 0);
        $menu->level = $request->input('level');
        $menu->status = (bool) $request->input('status');

        // Save the changes
        $menu->save();

        // Redirect to the index route
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index');
    }

    public function linkUser(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'user_id' => 'required|exists:users,id',
            'access_level' => 'required|in:owner,employee',
        ]);

        $menu = Menu::findOrFail($validated['menu_id']);
        $user = User::findOrFail($validated['user_id']);
        $menu->users()->attach($user, ['access_level' => $validated['access_level']]);

        return response()->json(['success' => true]);
    }
}
