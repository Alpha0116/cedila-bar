<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function __construct()
    {
        // Add basic admin check logic inline or via middleware (for brevity, inline here)
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $orders = Order::with('user', 'items.menuItem')->orderBy('created_at', 'desc')->get();
        $reservations = Reservation::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('orders', 'reservations'));
    }

    public function ordersIndex()
    {
        $orders = Order::with('user', 'items.menuItem')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function reservationsIndex()
    {
        $reservations = Reservation::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:received,prep,delivery,finished']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Statut de commande mis à jour.');
    }

    public function updateReservationStatus(Request $request, Reservation $reservation)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,rejected']);
        $reservation->update(['status' => $request->status]);
        return back()->with('success', 'Statut de réservation mis à jour.');
    }
}
