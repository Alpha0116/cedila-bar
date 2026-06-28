<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Storage;

class AdminMenuControleur extends Controller
{
    public function index()
    {
        $menus = MenuItem::orderBy('category')->orderBy('name')->paginate(15);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:food,drink,dessert',
            'is_available' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('menu', 'public');
        }

        MenuItem::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Article ajouté au menu avec succès.');
    }

    public function edit(MenuItem $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:food,drink,dessert',
            'is_available' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            if ($menu->image_path && !str_starts_with($menu->image_path, 'http')) {
                Storage::disk('public')->delete($menu->image_path);
            }
            $data['image_path'] = $request->file('image')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(MenuItem $menu)
    {
        if ($menu->image_path && !str_starts_with($menu->image_path, 'http')) {
            Storage::disk('public')->delete($menu->image_path);
        }
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Article supprimé du menu.');
    }
}
