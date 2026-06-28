<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('user.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'single_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            'accompanying_drink' => 'nullable|string',
            'special_request' => 'nullable|string',
        ]);

        $menuItem = MenuItem::find($request->single_item_id);
        $cart = session()->get('cart', []);

        // Use a unique id for each cart entry to allow duplicate items with different options
        $cartItemId = uniqid();

        $cart[$cartItemId] = [
            'menu_item_id' => $menuItem->id,
            'name' => $menuItem->name,
            'price' => $menuItem->price,
            'quantity' => $request->quantity,
            'accompanying_drink' => $request->accompanying_drink,
            'special_request' => $request->special_request,
            'image' => $menuItem->image ?? null,
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Plat ajouté au panier avec succès !');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Article retiré du panier.');
    }
}
