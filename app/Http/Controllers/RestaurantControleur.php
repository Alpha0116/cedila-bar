<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class RestaurantControleur extends Controller
{
    public function index()
    {
        $foodItems = MenuItem::where('is_available_today', true)
                            ->where('type', 'food')
                            ->get();

        $drinks = MenuItem::where('is_available_today', true)
                          ->where('type', 'drink')
                          ->get();
                            
        return view('restaurant.index', compact('foodItems', 'drinks'));
    }
}
