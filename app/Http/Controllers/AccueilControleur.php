<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Evenement;

class AccueilControleur extends Controller
{
    public function index()
    {
        $evenements = Evenement::where('is_published', true)->orderBy('event_date', 'asc')->get();
        $foodItems = \App\Models\MenuItem::where('is_available_today', true)
                            ->where('type', 'food')
                            ->take(6)
                            ->get();
                            
        return view('welcome', compact('evenements', 'foodItems'));
    }
}
