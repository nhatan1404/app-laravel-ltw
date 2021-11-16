<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function getListCart()
    {
        $carts = Cart::where('user_id', Auth::id())->first();
        return view('shop.user.cart', compact('carts'));
    }

    public function addToCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $carts = Cart::where('user_id', Auth::id())->first();
            $product = Product::findOrFail($id);

            if ($request->quantity > $product->quantity) {
                return response()->json(['error' => 'Quantity cannot larger than stock'], 400);
            }

            if ($carts) {
                $item = CartItem::where('cart_id', $carts->id)->where('product_id', $product->id)->first();
                if ($item) {
                    $item->quantity += 1;
                    $item->update();
                    return response()->json(['message' => 'Successful', 'total' => $carts->total, 'isUpdate' => false], 200);
                } else {
                    $cart_item = new CartItem();
                    $cart_item->cart_id = $carts->id;
                    $cart_item->product_id = $product->id;
                    $cart_item->quantity = $request->quantity;
                    $cart_item->save();
                    $list = collect(session('cart-list'));
                    $list->push($product->id);
                    $request->session()->put('cart-list', $list->all());
                    return response()->json(['message' => 'Successful', 'total' => $carts->total, 'isUpdate' => true], 200);
                }
            } else {
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->save();
                $cart_item = new CartItem();
                $cart_item->cart_id = $$carts->id;
                $cart_item->product_id = $product->id;
                $cart_item->quantity = $request->quantity;
                $cart_item->save();
                $list = collect(session('cart-list'));
                $list->push($product->id);
                $request->session()->put('cart-list', $list->all());
                return response()->json(['message' => 'Successful', 'total' => $carts->total, 'isUpdate' => true], 200);
            }
        }
        return response()->json(['error' => 'Error'], 400);
    }

    public function updateCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = CartItem::findOrFail($id);

            if (!$item) {
                return response()->json(['message' => 'Item not found'], 404);
            }

            if ($request->quantity > $item->product->quantity) {
                return response()->json(['error' => 'Quantity cannot larger than stock'], 400);
            }

            $item->quantity = $request->quantity;
            $status = $item->save();

            if ($status) {
                $total = $item->quantity * $item->product->price;
                return response()->json(['message' => 'Update successful', 'total' => $total], 200);
            } else {
                return response()->json(['message' => 'Item not found'], 404);
            }
        }
    }

    public function removeCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = CartItem::findOrFail($id);

            $status = $item->delete();
            if ($status) {
                return response()->json(['message' => 'Delete successful'], 200);
            } else {
                return response()->json(['message' => 'Item not found'], 404);
            }
        }
    }
}
