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

    public function cancelOrder($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        
        if ($order->status == 'received') {
            $order->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Votre commande a été annulée avec succès.');
        }

        return redirect()->back()->with('error', 'Vous ne pouvez plus annuler cette commande car elle est déjà en cours de traitement.');
    }

    public function cancelReservation($id)
    {
        $reservation = auth()->user()->reservations()->findOrFail($id);
        
        if ($reservation->status == 'pending') {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Votre réservation a été annulée avec succès.');
        }

        return redirect()->back()->with('error', 'Vous ne pouvez plus annuler cette réservation car elle a déjà été traitée.');
    }

    public function updateReservation(Request $request, $id)
    {
        $reservation = auth()->user()->reservations()->findOrFail($id);
        
        if ($reservation->status == 'pending') {
            $reservation->update([
                'reservation_date' => $request->reservation_date,
                'reservation_time' => $request->reservation_time,
                'guests' => $request->guests,
                'special_request' => $request->special_request,
            ]);
            return redirect()->back()->with('success', 'Votre réservation a été modifiée avec succès.');
        }

        return redirect()->back()->with('error', 'Vous ne pouvez plus modifier cette réservation car elle a déjà été traitée.');
    }
}
