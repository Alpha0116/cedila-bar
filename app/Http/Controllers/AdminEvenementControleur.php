<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use Illuminate\Support\Facades\Storage;

class AdminEvenementControleur extends Controller
{
    public function index()
    {
        $evenements = Evenement::orderBy('event_date', 'desc')->paginate(10);
        return view('admin.evenements.index', compact('evenements'));
    }

    public function create()
    {
        return view('admin.evenements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'is_published' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('events', 'public');
        }

        Evenement::create($data);

        return redirect()->route('admin.evenements.index')->with('success', 'Événement ajouté avec succès.');
    }

    public function edit(Evenement $evenement)
    {
        return view('admin.evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'is_published' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            if ($evenement->image_path && !str_starts_with($evenement->image_path, 'http')) {
                Storage::disk('public')->delete($evenement->image_path);
            }
            $data['image_path'] = $request->file('image')->store('events', 'public');
        }

        $evenement->update($data);

        return redirect()->route('admin.evenements.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        if ($evenement->image_path && !str_starts_with($evenement->image_path, 'http')) {
            Storage::disk('public')->delete($evenement->image_path);
        }
        $evenement->delete();

        return redirect()->route('admin.evenements.index')->with('success', 'Événement supprimé.');
    }
}
