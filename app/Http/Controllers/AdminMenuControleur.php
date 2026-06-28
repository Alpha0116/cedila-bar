<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminMenuControleur extends Controller
{
    public function index()
    {
        $menus = MenuItem::with('category')->orderBy('category_id')->orderBy('name')->paginate(15);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_available_today' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image', 'is_available');
        $data['is_available_today'] = $request->has('is_available');
        
        // Auto-assign type from category
        $category = Category::findOrFail($request->category_id);
        $data['type'] = $category->type;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('menu', 'public');
        }

        MenuItem::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Article ajouté au menu avec succès.');
    }

    public function edit(MenuItem $menu)
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_available_today' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image', 'is_available');
        $data['is_available_today'] = $request->has('is_available');

        // Auto-assign type from category
        $category = Category::findOrFail($request->category_id);
        $data['type'] = $category->type;

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
