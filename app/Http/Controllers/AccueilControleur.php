<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Evenement;

class AccueilControleur extends Controller
{
    public function index()
    {
        // Load categories that have available items, ordered by sort_order
        $categories = Category::with(['menuItems' => function($query) {
            $query->where('is_available_today', true);
        }])
        ->whereHas('menuItems', function($query) {
            $query->where('is_available_today', true);
        })
        ->orderBy('sort_order')
        ->get();

        $evenements = Evenement::where('is_published', true)->orderBy('event_date', 'asc')->get();

        return view('welcome', compact('evenements', 'categories'));
    }
}
