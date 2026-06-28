<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $orders = $user->orders()->latest()->get();
        $reservations = $user->reservations()->latest()->get();

        return view('user.orders.index', compact('orders', 'reservations'));
    }

    public function showOrder($id)
    {
        $order = auth()->user()->orders()->with('items.menuItem')->findOrFail($id);
        
        return view('user.orders.show', compact('order'));
    }
}
