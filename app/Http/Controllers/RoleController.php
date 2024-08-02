<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('menus')->get();
        $menus = Menu::all();
        $parentMenus = Menu::whereNull('parent_id')->get();
        return view('admin.roles.index', compact('roles', 'menus', 'parentMenus'));
    }

    /**
     * Show the form for creating the specified resource.
     */
    public function create()
    {
        $menus = Menu::all();
        return view('admin.roles.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $role = Role::create($request->only('title'));
        // Attach menus if necessary
        $role->menus()->sync($request->menus);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $menus =  Menu::where('status', true)
            ->orderBy('id', 'asc')
            ->orderBy('display_order', 'asc')
            ->get();

        return view('admin.roles.edit', compact('role', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('title'));
        // Update menus if necessary
        $role->menus()->sync($request->menus);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
