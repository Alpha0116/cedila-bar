<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Evenement;
use Carbon\Carbon;

class BarControleur extends Controller
{
    public function index()
    {
        // Load drink categories that have available items
        $categories = \App\Models\Category::with(['menuItems' => function($query) {
            $query->where('is_available_today', true);
        }])
        ->where('type', 'drink')
        ->whereHas('menuItems', function($query) {
            $query->where('is_available_today', true);
        })
        ->orderBy('sort_order')
        ->get();
        $today = Carbon::today();
        
        $evenementsAvenir = Evenement::where('is_published', true)
                               ->where('event_date', '>=', $today)
                               ->orderBy('event_date', 'asc')
                               ->get();
                               
        $evenementsPasses = Evenement::where('is_published', true)
                           ->where('event_date', '<', $today)
                           ->orderBy('event_date', 'desc')
                           ->get();
                            
        return view('bar.index', compact('categories', 'evenementsAvenir', 'evenementsPasses'));
    }

    public function like($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->increment('likes');
        
        return response()->json([
            'success' => true,
            'likes' => $evenement->likes
        ]);
    }
}
