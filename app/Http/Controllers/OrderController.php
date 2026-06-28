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
        $request->validate([
            'single_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            'delivery_type' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:delivery_type,delivery',
        ]);

        $menuItem = MenuItem::find($request->single_item_id);
        $totalPrice = $menuItem->price * $request->quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'received',
            'delivery_type' => $request->delivery_type,
            'delivery_address' => $request->delivery_address,
            'special_request' => $request->special_request,
            'total_price' => $totalPrice
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'menu_item_id' => $menuItem->id,
            'quantity' => $request->quantity,
            'price_at_time' => $menuItem->price
        ]);

        // Mock Notification logic here (email/sms)
        \Log::info("New Order created: " . $order->id);

        return redirect()->back()->with('success', 'Votre commande de ' . $menuItem->name . ' a été passée avec succès !');
    }
}
