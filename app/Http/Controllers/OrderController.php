<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('restaurant.accueil')->with('error', 'Votre panier est vide.');
        }

        $request->validate([
            'delivery_type' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:delivery_type,delivery',
            'payment_method' => 'required|in:cash,mobile',
            'global_special_request' => 'nullable|string',
            // needs_cutlery will just be a boolean based on its presence
        ]);

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'received',
            'delivery_type' => $request->delivery_type,
            'delivery_address' => $request->delivery_address,
            'total_price' => $totalPrice,
            'needs_cutlery' => $request->has('needs_cutlery'),
            'payment_method' => $request->payment_method,
            'special_request' => $request->global_special_request
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price_at_time' => $item['price'],
                'special_request' => $item['special_request'],
                'accompanying_drink' => $item['accompanying_drink'],
            ]);
        }

        // Vider le panier
        session()->forget('cart');

        // Mock Notification logic here (email/sms)
        \Log::info("New Order created from cart: " . $order->id);

        return redirect()->route('user.orders.index')->with('success', 'Votre commande a été passée avec succès !');
    }
}
