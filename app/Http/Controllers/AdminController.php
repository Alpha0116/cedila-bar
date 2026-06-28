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

    public function updateReservationStatus(Request $request, Reservation $reservation)
    {
        $reservation->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Statut de la réservation mis à jour.');
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        
        if ($request->status == 'confirmed' && !$order->confirmed_at) {
            $order->confirmed_at = now();
        } elseif ($request->status == 'prep' && !$order->prep_at) {
            if (!$order->confirmed_at) $order->confirmed_at = now();
            $order->prep_at = now();
        } elseif ($request->status == 'delivery' && !$order->delivery_at) {
            if (!$order->confirmed_at) $order->confirmed_at = now();
            if (!$order->prep_at) $order->prep_at = now();
            $order->delivery_at = now();
            if ($request->has('delivery_driver')) {
                $order->delivery_driver = $request->delivery_driver;
            }
        } elseif ($request->status == 'finished' && !$order->finished_at) {
            if (!$order->confirmed_at) $order->confirmed_at = now();
            if (!$order->prep_at) $order->prep_at = now();
            if ($order->delivery_type == 'delivery' && !$order->delivery_at) $order->delivery_at = now();
            $order->finished_at = now();
        }

        $order->save();
        
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }
}
