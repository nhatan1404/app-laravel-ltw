<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(15);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'province' => 'string|required',
            'district' => 'string|required',
            'ward' => 'string|required',
            'address' => 'string|required',
            'telephone' => 'numeric|required',
            'email' => 'string|required',
            'note' => 'nullable|string',
        ]);


        $carts = Cart::getCart();
        if (empty($carts)) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $order = new Order();
        $data = $request->all();
        $full_address = $request->address + ", " + $request->ward + ", " + $request->district + ", " + $request->province;

        $order['order_number'] = Helpers::generateOrderNumber(Order::count());
        $order['user_id'] = Auth::id();
        $order['address'] = $full_address;
        $order['status'] = 'new';
        $order->fill($data)->save();
        $carts->update(['order_id' => $order->id]);
        return response()->json(['order' => $order], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $this->validate($request, [
            'status' => 'required|in:new,accepted,delivering,cancel,done',
            'note' => 'nullable|string',
        ]);
        $data = $request->all();
        if ($request->status == 'delivering') {
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->quantity -= $item->quantity;
                $product->save();
            }
        }
        $status = $order->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật đơn hàng thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $status = $order->delete();
            if ($status) {
                request()->session()->flash('success', 'Xoá thành công đơn đặt hàng');
            } else {
                request()->session()->flash('error', 'Không thể xoá đơn đặt hàng');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            return redirect()->back();
        }
    }
}
