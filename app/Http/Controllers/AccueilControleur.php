<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Evenement;

class AccueilControleur extends Controller
{
    public function index()
    {
        $foodItems = MenuItem::where('is_available_today', true)
                            ->where('type', 'food')
                            ->take(6)
                            ->get();

        $evenements = Evenement::where('is_published', true)->orderBy('event_date', 'asc')->get();

        $drinks = MenuItem::where('is_available_today', true)
                          ->where('type', 'drink')
                          ->get();

        return view('welcome', compact('evenements', 'foodItems', 'drinks'));
    }
}
