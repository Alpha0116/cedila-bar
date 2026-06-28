<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class RestaurantControleur extends Controller
{
    public function index()
    {
        // Load food categories that have available items
        $categories = Category::with(['menuItems' => function($query) {
            $query->where('is_available_today', true);
        }])
        ->where('type', 'food')
        ->whereHas('menuItems', function($query) {
            $query->where('is_available_today', true);
        })
        ->orderBy('sort_order')
        ->get();
                            
        return view('restaurant.index', compact('categories'));
    }
}
